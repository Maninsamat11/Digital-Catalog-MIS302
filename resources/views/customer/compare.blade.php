@extends('layouts.app')

@section('title', 'Compare Products — Mood Set-Up Studio')

@push('styles')
<style>
/* ── COMPARE MATRIX GLASS PANEL ── */
.compare-container {
    background: rgba(255, 255, 255, 0.55);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 28px;
    padding: 3rem;
    box-shadow: 0 4px 30px rgba(0,0,0,0.02), 0 30px 60px rgba(0,0,0,0.02);
    margin-bottom: 5rem;
}

.compare-meta-header {
    margin-bottom: 3.5rem;
    text-align: center;
}

.compare-title-sub {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 0.65rem;
    letter-spacing: 2px;
    color: var(--accent);
    text-transform: uppercase;
    display: block;
    margin-bottom: 0.3rem;
}

.compare-title-main {
    font-family: 'Syne', sans-serif;
    font-size: 2.2rem;
    font-weight: 800;
    color: #1d1d1f;
    letter-spacing: -1.5px;
    text-transform: uppercase;
}

/* ── MATRIX TABLE ── */
.matrix-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.matrix-table th, .matrix-table td {
    padding: 1.5rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.matrix-table th {
    background: transparent;
    padding-bottom: 2rem;
}

/* Row Labels Column */
.spec-label {
    font-family: 'Syne', sans-serif;
    font-size: 0.72rem;
    font-weight: 800;
    color: var(--muted);
    letter-spacing: 1.5px;
    text-transform: uppercase;
    width: 180px;
}

/* Values Columns */
.spec-val {
    font-size: 0.9rem;
    font-weight: 500;
    color: #1d1d1f;
}

/* Elegant product image inside the matrix */
.matrix-img-box {
    width: 110px;
    height: 110px;
    border-radius: 16px;
    overflow: hidden;
    background: #fbfbfd;
    border: 1px solid rgba(0, 0, 0, 0.05);
    margin: 0 auto 1rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    transition: transform 0.3s ease;
}
.matrix-img-box:hover {
    transform: scale(1.03);
}
.matrix-img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.matrix-p-name {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 0.95rem;
    color: #1d1d1f;
    line-height: 1.3;
}

/* Empty State */
.compare-empty {
    text-align: center;
    padding: 6rem 2rem;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 24px;
    box-shadow: 0 4px 30px rgba(0,0,0,0.01);
    max-width: 600px;
    margin: 5rem auto;
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

@if($products->isEmpty())
    {{-- EMPTY COMPARISON STATE --}}
    <div class="compare-empty">
        <div class="empty-icon-wrap">
            <svg width="24" height="24" fill="none" stroke="var(--accent)" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M18 20V10M12 20V4M6 20v-6"/>
            </svg>
        </div>
        <h3 style="font-family: 'Syne', sans-serif; font-size: 1.2rem; font-weight: 800; color: #1d1d1f; margin-bottom: 0.5rem; text-transform: uppercase;">NO ASSETS MOUNTED</h3>
        <p style="color:var(--muted); font-size:0.9rem; max-width: 320px; margin: 0 auto 1.5rem; line-height: 1.4;">Your comparison stack is currently unpopulated. Select up to three catalog nodes to run an analytical comparison.</p>
        <a href="{{ route('home') }}" class="btn btn-apple primary btn-sm" style="display: inline-flex;">Browse Inventory</a>
    </div>
@else
    {{-- ACTIVE MATRIX VIEW --}}
    <div style="margin-top: 3rem;">
        
        {{-- Header Section --}}
        <div class="compare-meta-header">
            <span class="compare-title-sub">SPECIFICATION ANALYSIS MATRIX</span>
            <h1 class="compare-title-main">Compare Assets</h1>
        </div>

        {{-- Frosted Comparison Card --}}
        <div class="compare-container">
            <div style="overflow-x:auto;">
                <table class="matrix-table">
                    <thead>
                        <tr>
                            <th class="spec-label">Hardware Node</th>
                            @foreach($products as $p)
                                <th style="text-align: center;">
                                    <a href="{{ route('product.show', $p) }}" style="text-decoration:none;">
                                        <div class="matrix-img-box">
                                            <img src="{{ asset('storage/'.$p->product_image) }}" alt="{{ $p->product_name }}">
                                        </div>
                                        <p class="matrix-p-name">{{ $p->product_name }}</p>
                                    </a>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="spec-label">Brand</td>
                            @foreach($products as $p)
                                <td class="spec-val" style="text-align: center; color: var(--muted);">{{ $p->brand }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="spec-label">Category</td>
                            @foreach($products as $p)
                                <td class="spec-val" style="text-align: center;">{{ $p->category->category_name }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="spec-label">Price</td>
                            @foreach($products as $p)
                                <td class="spec-val" style="text-align: center; font-weight: 700; color: var(--accent); font-size: 1rem;">
                                    ${{ number_format($p->price, 2) }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="spec-label">Stock status</td>
                            @foreach($products as $p)
                                <td class="spec-val" style="text-align: center;">{{ $p->stock_quantity }} units</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="spec-label">System State</td>
                            @foreach($products as $p)
                                <td style="text-align: center;">
                                    @if($p->status === 'available')
                                        <span class="chip chip-green" style="font-size:0.65rem;">Active</span>
                                    @else
                                        <span class="chip chip-red" style="font-size:0.65rem;">Offline</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="spec-label">Specifications</td>
                            @foreach($products as $p)
                                <td class="spec-val" style="color: var(--muted); line-height: 1.5; font-size: 0.8rem; max-width: 250px; text-align: left; padding: 1.5rem;">
                                    {{ Str::limit($p->description, 150) }}
                                </td>
                            @endforeach
                        </tr>
                        <tr style="border-bottom: none;">
                            <td></td>
                            @foreach($products as $p)
                                <td style="text-align: center; padding-top: 2rem;">
                                    <a href="{{ route('product.show', $p) }}" class="btn btn-apple secondary btn-sm" style="font-size: 0.7rem;">Initialize Node →</a>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Bottom Utility Controls --}}
        <div style="text-align:center; margin-bottom: 5rem;">
            <button class="btn btn-apple primary" onclick="clearCompare(); window.location='{{ route('home') }}'">
                FLUSH MATRIX & EXPLORE MORE
            </button>
        </div>
    </div>
@endif

@endsection