@extends('layouts.admin')

@section('title', (isset($category) ? 'Edit' : 'New') . ' Category — Mood Set-Up Studio')
@section('topbar-title', isset($category) ? 'Edit Category' : 'New Category')

@section('content')

<div style="max-width:600px; margin: 0 auto;">
    <div class="card">
        <div class="card-header">
            <h3>{{ isset($category) ? 'Update Category' : 'Create New Category' }}</h3>
        </div>
        <div class="card-body">
            {{-- Removed enctype and file input to ensure Vercel stability --}}
            <form method="POST"
                  action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
                @csrf
                @if(isset($category)) @method('PUT') @endif

                {{-- Category Name --}}
                <div class="form-group">
                    <label>Category Name *</label>
                    <input type="text" name="category_name" class="form-control"
                           value="{{ old('category_name', $category->category_name ?? '') }}" 
                           placeholder="e.g. Keyboards" required>
                    @error('category_name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                {{-- Category Image URL/Path --}}
                <div class="form-group">
                    <label>Category Icon/Photo URL</label>
                    <input type="text" name="category_image" id="category_image_input" class="form-control" 
                           value="{{ old('category_image', $category->category_image ?? '') }}" 
                           placeholder="categories/filename.png or https://...">
                
                    @error('category_image')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                {{-- LIVE PREVIEW SECTION --}}
                <div style="margin-top: 1.5rem; padding: 1.25rem; background: var(--ghost); border-radius: 12px; border: 1px dashed var(--line); display: flex; align-items: center; gap: 1.5rem;">
                    <div style="width: 80px; height: 80px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid var(--line); flex-shrink: 0;">
                        @php
                            $currentImg = isset($category) ? $category->category_image : '';
                            $isUrl = Str::startsWith($currentImg, ['http', 'https']);
                            $previewPath = $currentImg ? ($isUrl ? $currentImg : asset($currentImg)) : asset('products/placeholder.jpg');
                        @endphp
                        <img id="category-preview" src="{{ $previewPath }}" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    <div>
                        <h4 style="font-size: 0.8rem; margin-bottom: 0.2rem;">Preview</h4>
                        <p style="font-size: 0.7rem; color: var(--muted); line-height: 1.4;">
    
                        </p>
                    </div>
                </div>

                <div style="display:flex; gap:0.75rem; margin-top:2rem;">
                    <button type="submit" class="btn btn-primary" style="padding: 0.6rem 1.5rem;">
                        {{ isset($category) ? 'Update Category' : 'Create Category' }}
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline" style="padding: 0.6rem 1.5rem;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Live update logic for Category Preview
    const catInput = document.getElementById('category_image_input');
    const catPreview = document.getElementById('category-preview');

    catInput.addEventListener('input', function() {
        let val = this.value.trim();
        if (val) {
            // Check if it's an external link or local path
            if (val.startsWith('http')) {
                catPreview.src = val;
            } else {
                // Prepend base URL for local public/ folder
                catPreview.src = "{{ asset('') }}" + val;
            }
        } else {
            catPreview.src = "{{ asset('products/placeholder.jpg') }}";
        }
    });
</script>
@endpush

@endsection