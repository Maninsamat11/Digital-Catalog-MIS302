@extends('layouts.admin')

@section('title', 'New Product — Admin')
@section('topbar-title', 'New Product')

@section('content')

<div style="max-width:720px;">
    <div class="card">
        <div class="card-header">
            <h3>New Product</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid-2">
                    <div class="form-group">
                        <label>Product Name *</label>
                        <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" required>
                        @error('product_name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label>Brand *</label>
                        <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required>
                        @error('brand')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Category *</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label>Description *</label>
                    <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
                    @error('description')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Price ($) *</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" step="0.01" min="0" required>
                        @error('price')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label>Stock Quantity *</label>
                        <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', 0) }}" min="0" required>
                        @error('stock_quantity')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="out_of_stock" {{ old('status') === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                        @error('status')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label>Product Image *</label>
                        <input type="file" name="product_image" class="form-control" accept="image/*" required>
                        @error('product_image')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div style="display:flex;gap:0.75rem;margin-top:0.5rem;">
                    <button type="submit" class="btn btn-primary">Create Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
