{{--
    partials/product-card.blade.php
    Usage: @include('partials.product-card', ['product' => $product])

    IMPORTANT for compare to work:
    - data-id must be the raw integer {{ $product->id }}
    - onclick must call toggleCompare with that same id as a string '{{ $product->id }}'
    - Both are coerced to String inside toggleCompare() so they always match
--}}

<div class="card product-card">

    {{-- ── IMAGE ── --}}
    <div class="img-wrap">
        @if($product->product_image && $product->product_image !== 'products/placeholder.jpg')
            <img
                src="{{ asset('storage/' . $product->product_image) }}"
                alt="{{ $product->product_name }}"
                loading="lazy"
            >
        @else
            {{-- Placeholder when no image uploaded --}}
            <div style="
                width:100%; height:100%;
                display:flex; align-items:center; justify-content:center;
                background: #f2f2f7; color: #c7c7cc;
            ">
                <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="2" y="3" width="20" height="14" rx="2"/>
                    <path d="M8 21h8M12 17v4"/>
                </svg>
            </div>
        @endif

        {{-- ── BADGES ── --}}
        @if(($product->stock_quantity ?? 1) <= 0)
            <span class="badge-oos">Out of Stock</span>
        @elseif(($product->stock_quantity ?? 99) <= ($product->stock_threshold ?? 5))
            <span class="badge-oos" style="background:rgba(206,53,48,0.82);">Low Stock</span>
        @elseif($product->status === 'new' || ($product->tags && str_contains($product->tags, 'New')))
            <span class="badge-oos badge-new">New</span>
        @endif

        {{-- ── COMPARE BUTTON ──
             KEY: data-id="{{ $product->id }}" must match what toggleCompare() stores.
             Both the attribute and the JS call use the same raw integer, coerced to string.
        --}}
        <button
            class="compare-check"
            data-id="{{ $product->id }}"
            onclick="toggleCompare('{{ $product->id }}')"
            aria-label="Add to compare"
            type="button"
        >
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
            </svg>
            <span class="compare-label">Compare</span>
        </button>
    </div>

    {{-- ── INFO ── --}}
    <div class="info">
        <div class="brand">{{ $product->brand ?? '' }}</div>
        <div class="name">{{ $product->product_name }}</div>
        <div style="display:flex; align-items:baseline; gap:0.5rem;">
            <span class="price">${{ number_format($product->price, 2) }}</span>
            @if(isset($product->original_price) && $product->original_price > $product->price)
                <span style="font-size:0.8rem; color:#8e8e93; text-decoration:line-through;">
                    ${{ number_format($product->original_price, 2) }}
                </span>
            @endif
        </div>
    </div>

    {{-- Full-card clickable link (sits above card, below compare button via z-index) --}}
    <a
        href="{{ route('product.show', $product) }}"
        style="position:absolute; inset:0; z-index:1;"
        aria-label="View {{ $product->product_name }}"
    ></a>

    {{-- Compare button needs to sit above the card link --}}
    <style>
        .compare-check { position: absolute; z-index: 2; }
        .badge-oos, .badge-new { position: absolute; z-index: 2; }
    </style>

</div>