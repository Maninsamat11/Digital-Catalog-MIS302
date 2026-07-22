<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\UserInteraction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $featuredProducts = Product::with('category')
            ->where('status', 'available')
            ->latest()
            ->take(8)
            ->get();

        return view('customer.home', compact('categories', 'featuredProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $categoryId = $request->input('category');

        $products = Product::with('category')
            ->when($query, function ($q) use ($query) {
                $q->where('product_name', 'like', "%{$query}%")
                  ->orWhere('brand', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->get();

        // Log search interaction
        if ($query) {
            UserInteraction::create([
                'user_id'          => auth()->id(),
                'product_id'       => null,
                'interaction_type' => 'search',
            ]);
        }

        $categories = Category::all();
        return view('customer.search', compact('products', 'query', 'categories', 'categoryId'));
    }

    public function category(Category $category)
    {
        $products = $category->products()->where('status', 'available')->get();
        return view('customer.category', compact('category', 'products'));
    }

    public function product(Product $product)
    {
        // Log view interaction
        UserInteraction::create([
            'user_id'          => auth()->id(),
            'product_id'       => $product->id,
            'interaction_type' => 'view',
        ]);

        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'available')
            ->take(4)
            ->get();

        return view('customer.product', compact('product', 'related'));
    }

    public function compare(Request $request)
    {
        $ids = array_filter(explode(',', $request->input('ids', '')));
        $products = Product::with('category')->whereIn('id', $ids)->get();

        // Log compare interaction
        foreach ($products as $p) {
            UserInteraction::create([
                'user_id'          => auth()->id(),
                'product_id'       => $p->id,
                'interaction_type' => 'compare',
            ]);
        }

        return view('customer.compare', compact('products'));
    }
    
    public function matcher(Request $request)
{
    // If no data is sent, just show the quiz page
    if (!$request->has('budget')) {
        return view('customer.matcher');
    }

    $query = Product::query();

    // 1. Filter by Budget
    if ($request->budget == 'budget') {
        $query->where('price', '<', 100);
    } elseif ($request->budget == 'mid') {
        $query->whereBetween('price', [100, 300]);
    } elseif ($request->budget == 'premium') {
        $query->where('price', '>', 300);
    }

    // 2. Filter by Use Case (looking into the tags column)
    if ($request->use_case) {
        $query->where('tags', 'like', '%' . $request->use_case . '%');
    }

    $products = $query->where('status', 'available')->get();

    return view('customer.search', [
        'products' => $products,
        'query' => 'Your Personalized Studio Match',
        'categories' => \App\Models\Category::all(),
        'categoryId' => null
    ]);
}
}
