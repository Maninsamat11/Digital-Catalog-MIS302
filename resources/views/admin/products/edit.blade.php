@extends('layouts.admin')

@section('title', 'Edit Product — Admin')
@section('topbar-title', 'Edit Product')

@section('content')

<div style="max-width:720px;">
    <div class="card">
        <div class="card-header">
            <h3>Edit Product</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="grid-2">
                    <div class="form-group">
                        <label>Product Name *</label>
                        <input type="text" name="product_name" class="form-control"
                               value="{{ old('product_name', $product->product_name) }}" required>
                        @error('product_name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label>Brand *</label>
                        <input type="text" name="brand" class="form-control"
                               value="{{ old('brand', $product->brand) }}" required>
                        @error('brand')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Category *</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label>Description *</label>
                    <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Price ($) *</label>
                        <input type="number" name="price" class="form-control"
                               value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
                        @error('price')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label>Stock Quantity *</label>
                        <input type="number" name="stock_quantity" class="form-control"
                               value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0" required>
                        @error('stock_quantity')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="available" {{ old('status', $product->status) === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="out_of_stock" {{ old('status', $product->status) === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                        @error('status')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label>Product Image</label>
                        <div style="margin-bottom:0.5rem;">
                            <img src="{{ asset('storage/'.$product->product_image) }}"
                                 style="width:60px;height:60px;object-fit:cover;border-radius:8px;border:1px solid var(--border);">
                            <p style="font-size:0.72rem;color:var(--muted);margin-top:0.3rem;">Upload to replace</p>
                        </div>
                        <input type="file" name="product_image" class="form-control" accept="image/*">
                        @error('product_image')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div style="display:flex;gap:0.75rem;margin-top:0.5rem;">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
