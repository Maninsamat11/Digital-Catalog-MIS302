{{--
    partials/product-card.blade.php
    Updated for Vercel/Public Folder support
--}}

<div class="card product-card">

    {{-- ── IMAGE ── --}}
    <div class="img-wrap">
        @if($product->product_image)
            @php
                $img = $product->product_image;
                // Check if it's a web link or a local file in public/
                $isUrl = Str::startsWith($img, ['http://', 'https://']);
                // Use asset() without 'storage/' if it's a local path
                $finalPath = $isUrl ? $img : asset($img);
            @endphp
            <img
                src="{{ $finalPath }}"
                alt="{{ $product->product_name }}"
                loading="lazy"
                onerror="this.src='{{ asset('products/placeholder.jpg') }}'"
            >
        @else
            {{-- Placeholder when no image data exists --}}
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

        {{-- ── COMPARE BUTTON ── --}}
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

    {{-- Full-card clickable link --}}
    <a
        href="{{ route('product.show', $product) }}"
        style="position:absolute; inset:0; z-index:1;"
        aria-label="View {{ $product->product_name }}"
    ></a>

    <style>
        .compare-check { position: absolute; z-index: 2; }
        .badge-oos, .badge-new { position: absolute; z-index: 2; }
    </style>

</div>