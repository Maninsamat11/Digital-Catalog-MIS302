@extends('layouts.app')

@section('title', $product->product_name . ' — Mood Set-Up Studio')

@push('styles')
<style>
/* ── PRODUCT PAGE SPECIFICS ── */
.product-meta-brand {
    font-family: 'Space Grotesque', sans-serif;
    font-size: 0.72rem;
    font-weight: 700;
    color: var(--accent);
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
}

.product-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(2rem, 4vw, 2.8rem);
    font-weight: 800;
    line-height: 1.05;
    color: #1d1d1f;
    letter-spacing: -1px;
    margin-bottom: 1rem;
    text-transform: uppercase;
}

.product-price {
    font-family: 'Syne', sans-serif;
    font-size: 2.2rem;
    font-weight: 800;
    color: #1d1d1f;
    letter-spacing: -0.5px;
}

/* Glass table override */
.spec-table-card {
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 1.8rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.01);
}

.spec-table {
    width: 100%;
    border-collapse: collapse;
}

.spec-table td {
    padding: 1.2rem 1.5rem;
    font-size: 0.85rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.04);
}

.spec-table tr:last-child td {
    border-bottom: none;
}

/* Elegant QR takeaway block mimicking an Apple packing card */
.qr-takeaway-capsule {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    box-shadow: 0 4px 24px rgba(0,0,0,0.01);
}

.qr-code-holder {
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.05);
    padding: 8px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
}

/* Action button configurations */
.action-grid {
    display: flex;
    gap: 12px;
    margin-bottom: 2rem;
}

.action-grid .btn-apple {
    flex: 1;
    justify-content: center;
}

/* ── PRODUCT DETAIL LAYOUT (image + info) ── */
.product-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    margin-bottom: 6rem;
    align-items: start;
}

.product-detail-breadcrumb {
    margin-bottom: 2.5rem;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    overflow-wrap: break-word;
}

/* ══════════════════════════════════════════════
   📱 RESPONSIVE
   ══════════════════════════════════════════════ */

/* Tablet: image and info still side by side but tighter */
@media (max-width: 1024px) {
    .product-detail-grid { gap: 2.5rem; }
}

/* Phone/small tablet: image goes full-width on top, info stacks below */
@media (max-width: 800px) {
    .product-detail-grid {
        grid-template-columns: 1fr;
        gap: 1.75rem;
        margin-bottom: 3.5rem;
    }
    .product-detail-breadcrumb { margin-bottom: 1.5rem; }
}

@media (max-width: 480px) {
    .product-price { font-size: 1.7rem; }
    .spec-table td { padding: 0.9rem 1rem; }
    .action-grid { flex-direction: column; }
    .qr-takeaway-capsule { flex-direction: column; text-align: center; }
}
</style>
@endpush

@section('content')

{{-- Breadcrumbs --}}
<div class="product-detail-breadcrumb">
    <a href="{{ route('home') }}" style="color:var(--muted); text-decoration:none;">Home</a>
    <span style="margin:0 0.5rem; color:var(--muted);">/</span>
    <a href="{{ route('category.show', $product->category) }}" style="color:var(--muted); text-decoration:none;">{{ $product->category->category_name }}</a>
    <span style="margin:0 0.5rem; color:var(--muted);">/</span>
    <span style="color:#1d1d1f;">{{ $product->product_name }}</span>
</div>

{{-- Main Details Grid --}}
<div class="product-detail-grid">

    {{-- Product Image Cover --}}
    <div>
        <div class="product-card" style="background:#ffffff; border-radius:24px; padding:2rem; overflow:hidden; aspect-ratio:1; box-shadow: 0 10px 40px rgba(0,0,0,0.03); display:flex; align-items:center; justify-content:center;">
            @php
                $img = $product->product_image;
                $isUrl = Str::startsWith($img, ['http://', 'https://']);
                // Use asset() directly for files in public/products (No 'storage/')
                $finalPath = $isUrl ? $img : asset($img);
            @endphp
            
            <img src="{{ $finalPath }}" 
                 alt="{{ $product->product_name }}"
                 style="max-width:100%; max-height:100%; object-fit:contain;"
                 onerror="this.onerror=null; this.src='{{ asset('products/placeholder.jpg') }}';">
        </div>
    </div>

    {{-- Product Meta Details --}}
    <div>
        <p class="product-meta-brand">{{ $product->brand }}</p>
        <h1 class="product-title">{{ $product->product_name }}</h1>

        <div style="display:flex; align-items:center; gap:1.5rem; flex-wrap:wrap; margin-bottom:2rem;">
            <span class="product-price">${{ number_format($product->price, 2) }}</span>
            @if($product->status === 'available')
                <span class="chip chip-green" style="font-size:0.65rem;">In Stock ({{ $product->stock_quantity }} units)</span>
            @else
                <span class="chip chip-red" style="font-size:0.65rem;">out of Stock</span>
            @endif
        </div>

        <div style="border-top:1px solid rgba(0,0,0,0.06); padding-top:1.5rem; margin-bottom:2rem;">
            <p style="color:var(--muted); line-height:1.6; font-size: 0.95rem;">{{ $product->description }}</p>
        </div>

        {{-- Specifications Matrix Table --}}
        <div class="spec-table-card">
            <table class="spec-table">
                <tbody>
                    <tr>
                        <td style="font-family:'Syne', sans-serif; font-weight:800; color:var(--muted); width:40%; font-size: 0.72rem; letter-spacing:1px; text-transform:uppercase;">Category</td>
                        <td style="font-weight:600; color:#1d1d1f;">{{ $product->category->category_name }}</td>
                    </tr>
                    <tr>
                        <td style="font-family:'Syne', sans-serif; font-weight:800; color:var(--muted); font-size: 0.72rem; letter-spacing:1px; text-transform:uppercase;">Brand Identifier</td>
                        <td style="font-weight:600; color:#1d1d1f;">{{ $product->brand }}</td>
                    </tr>
                    <tr>
                        <td style="font-family:'Syne', sans-serif; font-weight:800; color:var(--muted); font-size: 0.72rem; letter-spacing:1px; text-transform:uppercase;">Stock Quantity</td>
                        <td style="font-weight:600; color:#1d1d1f;">{{ $product->stock_quantity }} units</td>
                    </tr>
                    <tr>
                        <td style="font-family:'Syne', sans-serif; font-weight:800; color:var(--muted); font-size: 0.72rem; letter-spacing:1px; text-transform:uppercase;">System Status</td>
                        <td>
                            @if($product->status === 'available')
                                <span class="chip chip-green" style="font-size:0.65rem;">Available</span>
                            @else
                                <span class="chip chip-red" style="font-size:0.65rem;">Out of Stock </span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Configuration Actions --}}
        <div class="action-grid">
            <button class="btn btn-apple primary" onclick="toggleCompare('{{ $product->id }}')">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right:8px;"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
                ADD TO COMPARE
            </button>
            <a href="{{ route('search', ['category' => $product->category_id]) }}" class="btn btn-apple secondary">
                BROWSE SIMILAR
            </a>
        </div>
        

    </div>
</div>

{{-- Related Hardware Assets Section --}}
@if($related->isNotEmpty())
<section style="margin-bottom: 5rem;">
    <div class="section-label">
        <div>
            <div class="section-divider"></div>
            <h2>SIMILAR HARDWARE NODES <small style="color:var(--muted); font-size:0.72rem; margin-left:8px;">/ RELATED</small></h2>
        </div>
    </div>
    <div class="product-grid">
        @foreach($related as $relProduct)
            @include('partials.product-card', ['product' => $relProduct])
        @endforeach
    </div>
</section>
@endif

@endsection