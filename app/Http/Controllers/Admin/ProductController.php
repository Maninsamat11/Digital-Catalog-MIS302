<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductsImport; 
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::all(); // Needed for the filter dropdown

    $products = Product::with('category')
        ->when($request->search, function($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        })
        ->when($request->category, function($query, $category_id) {
            $query->where('category_id', $category_id);
        })
        ->when($request->brand, function($query, $brand) {
            $query->where('brand', 'like', "%{$brand}%");
        })
        ->latest()
        ->get();

    return view('admin.products.index', compact('products', 'categories'));
}

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'product_name'   => 'required|string|max:255',
        'category_id'    => 'required|exists:categories,id',
        'brand'          => 'required|string',
        'price'          => 'required|numeric',
        'stock_quantity' => 'required|integer',
        'product_image'  => 'required|string', // Changed to string
        'description'    => 'required|string',
        'status'         => 'required|in:available,out_of_stock',
    ]);

    Product::create($data);

    return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
}

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
{
    $data = $request->validate([
        'product_name'   => 'required|string|max:255',
        'category_id'    => 'required|exists:categories,id',
        'price'          => 'required|numeric',
        'stock_quantity' => 'required|integer',
        'product_image'  => 'nullable|string', // Change from 'image' to 'string'
        'description'    => 'nullable|string',
        'status'         => 'required|in:available,out_of_stock',
    ]);

    // Simply update the record with the text URL/Path
    $product->update($data);

    return redirect()->route('admin.products.index')->with('success', 'Product updated!');
}

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->product_image);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    public function import(Request $request) 
{
    $request->validate([
        'import_file' => 'required|mimes:csv,txt,xlsx'
    ]);

    Excel::import(new ProductsImport, $request->file('import_file'));
            
    return redirect()->back()->with('success', 'All products imported successfully!');
}
}


