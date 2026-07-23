@extends('layouts.admin')

@section('title', 'New Product — TechVault')
@section('topbar-title', 'Add New Product')

@section('content')

<div style="max-width:850px; margin: 0 auto;">
    <div class="card">
        <div class="card-header">
            <h3>Create New Catalog Item</h3>
        </div>
        <div class="card-body">
            {{-- Removed enctype because we are using text URLs now --}}
            <form method="POST" action="{{ route('admin.products.store') }}">
                @csrf

                <div class="grid-2">
                    <div class="form-group">
                        <label>Product Name *</label>
                        <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" placeholder="e.g. Sony WH-1000XM5" required>
                        @error('product_name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label>Brand *</label>
                        <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" placeholder="e.g. Sony" required>
                        @error('brand')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Category *</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label>Description *</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Detailed product specifications..." required>{{ old('description') }}</textarea>
                    @error('description')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Price ($) *</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" step="0.01" min="0" placeholder="0.00" required>
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
                        <label>Product Image (URL or Local Path) *</label>
                        <input type="text" name="product_image" id="product_image_input" class="form-control" 
                               value="{{ old('product_image') }}"
                               placeholder="products/filename.jpg or https://..." required>
                        @error('product_image')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- LIVE PREVIEW SECTION --}}
                <div style="margin-top: 1rem; padding: 1.5rem; background: var(--ghost); border-radius: 12px; border: 1px dashed var(--line); display: flex; align-items: center; gap: 2rem;">
                    <div style="width: 120px; height: 120px; background: #fff; border-radius: 12px; border: 1px solid var(--line); display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                        <img id="preview-img" src="{{ asset('products/placeholder.jpg') }}" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    <div>
                        <h4 style="font-size: 0.85rem; margin-bottom: 0.25rem;">Image Preview</h4>
                        
                    </div>
                </div>

                <div style="display:flex; gap:0.75rem; margin-top:2rem;">
                    <button type="submit" class="btn btn-teal" style="padding: 0.7rem 2.5rem;">Create Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline" style="padding: 0.7rem 2rem;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Live update preview logic
    const input = document.getElementById('product_image_input');
    const preview = document.getElementById('preview-img');

    input.addEventListener('input', function() {
        let val = this.value.trim();
        if (val) {
            if (val.startsWith('http')) {
                preview.src = val;
            } else {
                preview.src = "{{ asset('') }}" + val;
            }
        } else {
            preview.src = "{{ asset('products/placeholder.jpg') }}";
        }
    });
</script>
@endpush

@endsection