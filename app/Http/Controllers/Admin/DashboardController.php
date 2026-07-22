<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\UserInteraction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    // 1. Basic Stats
    $totalProducts    = Product::count();
    $totalCategories  = Category::count();
    $outOfStock       = Product::where('status', 'out_of_stock')->count();
    $totalInteractions = UserInteraction::count();

    // 2. SMART FEATURE: Restock Alerts (Stock < Threshold)
    // Avoid checking products that are already marked out of stock to keep the list clean
    $lowStockProducts = Product::where('status', 'available')
        ->whereRaw('stock_quantity <= stock_threshold')
        ->get();

    // 3. SMART FEATURE: Potential Lost Sales (Out of Stock but has high views)
    $potentialLostSales = Product::where('status', 'out_of_stock')
        ->withCount(['interactions' => function($q) {
            $q->where('interaction_type', 'view');
        }])
        ->having('interactions_count', '>', 0)
        ->orderBy('interactions_count', 'desc')
        ->take(3)
        ->get();

    // 4. Top Performing Products
    $topProducts = UserInteraction::with('product')
        ->select('product_id')
        ->selectRaw("SUM(CASE WHEN interaction_type = 'view' THEN 1 ELSE 0 END) as views_count")
        ->selectRaw("SUM(CASE WHEN interaction_type = 'search' THEN 1 ELSE 0 END) as search_count")
        ->selectRaw("SUM(CASE WHEN interaction_type = 'compare' THEN 1 ELSE 0 END) as compare_count")
        ->whereNotNull('product_id')
        ->groupBy('product_id')
        ->orderByRaw("
            SUM(CASE WHEN interaction_type = 'view' THEN 1 ELSE 0 END) +
            SUM(CASE WHEN interaction_type = 'search' THEN 1 ELSE 0 END) +
            SUM(CASE WHEN interaction_type = 'compare' THEN 1 ELSE 0 END) DESC
        ")
        ->take(5)
        ->get();

    // 5. Interactions by type
    $interactionsByType = UserInteraction::select('interaction_type', \DB::raw('count(*) as count'))
        ->groupBy('interaction_type')
        ->pluck('count', 'interaction_type');

    // 6. Daily interactions
    $dailyInteractions = UserInteraction::select(
            \DB::raw('DATE(interacted_at) as date'),
            \DB::raw('count(*) as count')
        )
        ->where('interacted_at', '>=', now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    return view('admin.dashboard', compact(
        'totalProducts', 
        'totalCategories', 
        'outOfStock', 
        'totalInteractions',
        'topProducts',       
        'interactionsByType', 
        'dailyInteractions',
        'lowStockProducts',
        'potentialLostSales'
    ));
}

    public function interactions()
{
    $allProducts = UserInteraction::with('product')
        ->select('product_id')
        ->selectRaw("SUM(CASE WHEN interaction_type = 'view' THEN 1 ELSE 0 END) as views_count")
        ->selectRaw("SUM(CASE WHEN interaction_type = 'search' THEN 1 ELSE 0 END) as search_count")
        ->selectRaw("SUM(CASE WHEN interaction_type = 'compare' THEN 1 ELSE 0 END) as compare_count")
        ->whereNotNull('product_id')
        ->groupBy('product_id')
        ->orderByRaw("
            SUM(CASE WHEN interaction_type = 'view' THEN 1 ELSE 0 END) +
            SUM(CASE WHEN interaction_type = 'search' THEN 1 ELSE 0 END) +
            SUM(CASE WHEN interaction_type = 'compare' THEN 1 ELSE 0 END) DESC
        ")
        ->paginate(20); // We use paginate so the page isn't too long

    return view('admin.interactions', compact('allProducts'));
}
}