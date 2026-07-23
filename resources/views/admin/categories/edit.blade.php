@extends('layouts.admin')

@section('title', 'Edit Category — Mood Set-Up Studio')
@section('topbar-title', 'Edit Category')

@section('content')

<div style="max-width:600px; margin: 0 auto;">
    <div class="card">
        <div class="card-header">
            <h3>Update Category Details</h3>
        </div>
        <div class="card-body">
            {{-- Removed enctype because we are using text URLs now --}}
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf 
                @method('PUT')

                {{-- Category Name --}}
                <div class="form-group">
                    <label>Category Name *</label>
                    <input type="text" name="category_name" class="form-control"
                           value="{{ old('category_name', $category->category_name) }}" required>
                    @error('category_name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                {{-- Category Image URL/Path --}}
                <div class="form-group">
                    <label>Category Icon/Photo URL</label>
                    <input type="text" name="category_image" id="category_image_input" class="form-control" 
                           value="{{ old('category_image', $category->category_image) }}" 
                           placeholder="e.g. categories/keyboard.png or https://link.com/img.png">
                    
                </div>

                {{-- Live Preview Section (Very professional for MIS projects) --}}
                <div style="margin-top: 1.5rem; padding: 1rem; background: var(--ghost); border-radius: 12px; border: 1px dashed var(--line);">
                    <p style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--muted); margin-bottom: 0.5rem;">Current Preview</p>
                    <div style="width: 80px; height: 80px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid var(--line);">
                        @php
                            $img = $category->category_image;
                            $path = Str::startsWith($img, ['http', 'https']) ? $img : asset($img);
                        @endphp
                        <img id="preview-img" src="{{ $path }}" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div style="display:flex; gap:0.75rem; margin-top:2rem;">
                    <button type="submit" class="btn btn-primary" style="padding: 0.6rem 1.5rem;">Save Changes</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline" style="padding: 0.6rem 1.5rem;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Small script to update preview when the text changes --}}
@push('scripts')
<script>
    const input = document.getElementById('category_image_input');
    const preview = document.getElementById('preview-img');

    input.addEventListener('input', function() {
        let val = this.value;
        if (val) {
            // If it doesn't start with http, assume it's a local asset
            if (!val.startsWith('http')) {
                preview.src = "{{ asset('') }}" + val;
            } else {
                preview.src = val;
            }
        }
    });
</script>
@endpush

@endsection