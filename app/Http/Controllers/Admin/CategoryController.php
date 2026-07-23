<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::withCount('products')
        ->when($request->search, function($query, $search) {
            $query->where('category_name', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

    return view('admin.categories.index', compact('categories'));
}

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'category_name' => 'required|string|unique:categories,category_name',
        'category_image' => 'nullable|string', 
    ]);

    Category::create($data);
    return redirect()->route('admin.categories.index')->with('success', 'Category created!');
}

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

public function update(Request $request, Category $category)
{
    $data = $request->validate([
        'category_name' => 'required|string|unique:categories,category_name,' . $category->id,
        'category_image' => 'nullable|string',
    ]);

    $category->update($data);
    return redirect()->route('admin.categories.index')->with('success', 'Category updated!');
}
    public function destroy(Category $category)
    {
        if ($category->category_image) {
            Storage::disk('public')->delete($category->category_image);
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }
}
