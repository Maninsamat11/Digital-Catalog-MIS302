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
            'category_name'  => 'required|string|max:255',
            'category_image' => 'nullable|string',
        ]);

        if ($request->hasFile('category_image')) {
            $data['category_image'] = $request->file('category_image')->store('categories', 'public');
        }

        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
{
    // 1. Change validation from 'image' to 'string'
    $request->validate([
        'category_name' => 'required|string|max:255',
        'category_image' => 'nullable|string', 
    ]);

    // 2. Update the category using all the data from the form
    $category->update([
        'category_name' => $request->category_name,
        'category_image' => $request->category_image, // This saves the URL text
    ]);

    return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
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
