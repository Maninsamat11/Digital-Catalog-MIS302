@extends('layouts.admin')

@section('title', (isset($category) ? 'Edit' : 'New') . ' Category — Admin')
@section('topbar-title', isset($category) ? 'Edit Category' : 'New Category')

@section('content')

<div style="max-width:560px;">
    <div class="card">
        <div class="card-header">
            <h3>{{ isset($category) ? 'Edit Category' : 'New Category' }}</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($category)) @method('PUT') @endif

                <div class="form-group">
                    <label>Category Name *</label>
                    <input type="text" name="category_name" class="form-control"
                           value="{{ old('category_name', $category->category_name ?? '') }}" required>
                    @error('category_name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label>Category Image</label>
                    @if(isset($category) && $category->category_image)
                        <div style="margin-bottom:0.6rem;">
                            <img src="{{ asset('storage/'.$category->category_image) }}" style="width:80px;height:80px;object-fit:cover;border-radius:10px;border:1px solid var(--border);">
                        </div>
                    @endif
                    <input type="file" name="category_image" class="form-control" accept="image/*">
                    @error('category_image')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div style="display:flex;gap:0.75rem;margin-top:1.5rem;">
                    <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create' }}</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
