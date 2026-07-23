@extends('layouts.admin')

@section('title', 'Categories — Admin')
@section('topbar-title', 'Categories')

@section('content')




<div class="card" style="margin-bottom: 1.5rem; padding: 1rem;">
    <form action="{{ route('admin.categories.index') }}" method="GET" style="display: flex; gap: 1rem; align-items: flex-end;">
        <div style="flex: 1;">
            <label style="font-size: 0.75rem; color: var(--muted); margin-bottom: 0.4rem; display: block;">Search Category Name</label>
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="e.g. Adapters, Keyboards...">
        </div>
        <button type="submit" class="btn btn-teal">Search</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Reset</a>
    </form>
</div>

<div class="card">

<div class="card">
    <div class="card-header">
        <h3>All Categories</h3>
        <a href="{{ route('admin.categories.create') }}"class="btn btn-teal btn-sm">+ New Category</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Products</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $cat)
            <tr>
                <td>
    <div style="width: 40px; height: 40px; background: #fff; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid var(--line);">
        @if($cat->category_image)
            @php
                // Check if it's a web link or a local file
                $isUrl = Str::startsWith($cat->category_image, ['http://', 'https://']);
                $imagePath = $isUrl ? $cat->category_image : asset($cat->category_image);
            @endphp
            <img src="{{ $imagePath }}" 
                 alt="{{ $cat->category_name }}" 
                 style="max-width: 100%; max-height: 100%; object-fit: contain;">
        @else
            <span style="color: var(--muted);">—</span>
        @endif
    </div>
</td>
                <td style="font-weight:600;">{{ $cat->category_name }}</td>
                <td><span class="chip chip-green">{{ $cat->products_count }}</span></td>
                <td style="color:var(--muted);">{{ $cat->created_at->format('M d, Y') }}</td>
                <td>
                    <div style="display:flex;gap:0.5rem;">
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2.5rem;">No categories yet. <a href="{{ route('admin.categories.create') }}" style="color:var(--accent);">Add one</a>.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
