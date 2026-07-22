@extends('layouts.app')

@section('title', 'Search — TechVault')

@push('styles')
<style>
/* ── SEARCH PAGE GLASS PANELS ── */
.search-sidebar {
    background: rgba(255, 255, 255, 0.55);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: 0 4px 30px rgba(0,0,0,0.01);
}

.search-meta-header {
    margin-bottom: 2.5rem;
}

.search-title-sub {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 0.65rem;
    letter-spacing: 2px;
    color: var(--accent);
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.3rem;
}

.search-title-main {
    font-family: 'Syne', sans-serif;
    font-size: 2rem;
    font-weight: 800;
    color: #1d1d1f;
    letter-spacing: -1px;
    text-transform: uppercase;
    line-height: 1.1;
}

/* ── TACTILE FILTER LIST ── */
.filter-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.filter-row-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    background: transparent;
    border: 1px solid transparent;
    border-radius: 12px;
    cursor: pointer;
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--muted);
    transition: all 0.25s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.filter-row-item input[type="radio"] {
    display: none; /* Hide native radio buttons */
}

/* Hover State */
.filter-row-item:hover {
    color: #1d1d1f;
    background: rgba(0, 0, 0, 0.02);
    border-color: rgba(0, 0, 0, 0.04);
}

/* Checked State (Apple Glass Highlight) */
.filter-row-item:has(input[type="radio"]:checked) {
    background: #1d1d1f;
    color: #ffffff;
    border-color: #1d1d1f;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

/* ── NO RESULTS ILLUSTRATION ── */
.empty-state {
    text-align: center;
    padding: 6rem 2rem;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 24px;
    box-shadow: 0 4px 30px rgba(0,0,0,0.01);
}

.empty-icon-wrap {
    width: 70px;
    height: 70px;
    background: rgba(0, 0, 0, 0.03);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    border: 1px solid rgba(0,0,0,0.02);
}
</style>
@endpush

@section('content')

<div style="display:flex; gap:2.5rem; align-items:flex-start; margin-top: 3rem; margin-bottom: 5rem;">

    {{-- SIDEBAR FILTERS --}}
    <aside style="width:260px; flex-shrink:0;">
        <div class="search-sidebar">
            <p style="font-family:'Syne', sans-serif; font-weight:800; text-transform: uppercase; margin-bottom:1.5rem; font-size:0.75rem; letter-spacing: 2px; color: #1d1d1f;">FILTER NODES</p>
            
            <form action="{{ route('search') }}" method="GET" id="filterForm">
                <input type="hidden" name="q" value="{{ $query }}">
                
                <div class="filter-list">
                    <label class="filter-row-item">
                        <input type="radio" name="category" value="" {{ !$categoryId ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()">
                        <span>All Categories</span>
                    </label>
                    
                    @foreach($categories as $cat)
                    <label class="filter-row-item">
                        <input type="radio" name="category" value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()">
                        <span>{{ $cat->category_name }}</span>
                    </label>
                    @endforeach
                </div>
            </form>
        </div>
    </aside>

    {{-- RESULTS AREA --}}
    <div style="flex:1;">
        
        {{-- Search Meta Header --}}
        <div class="search-meta-header">
            
            <h1 class="search-title-main">
                {{ $query ? "Results for \"$query\"" : 'All Products' }}
            </h1>
            <p style="color:var(--muted); font-size:0.8rem; font-weight: 700; text-transform: uppercase; margin-top:0.4rem; letter-spacing: 1px;">
                {{ $products->count() }} result(s) 
            </p>
        </div>

        {{-- Product Display --}}
        @if($products->isEmpty())
            <div class="empty-state">
                <div class="empty-icon-wrap">
                    <svg width="24" height="24" fill="none" stroke="var(--accent)" stroke-width="1.5" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                </div>
                <h3 style="font-family: 'Syne', sans-serif; font-size: 1.2rem; font-weight: 800; color: #1d1d1f; margin-bottom: 0.5rem; text-transform: uppercase;">ZERO MATCHES RESOLVED</h3>
                <p style="color:var(--muted); font-size:0.9rem; max-width: 320px; margin: 0 auto 1.5rem; line-height: 1.4;">We couldn't resolve any hardware assets matching your current terminal query. Try refining your parameters.</p>
                <a href="{{ route('search') }}" class="btn btn-apple secondary btn-sm" style="display: inline-flex;">Reset Search</a>
            </div>
        @else
            <div class="product-grid">
                @foreach($products as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection