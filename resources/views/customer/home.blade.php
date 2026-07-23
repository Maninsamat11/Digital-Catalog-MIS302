@extends('layouts.app')

@section('title', 'Home — Mood Set-Up Studio')

@push('styles')
<style>
/* ══════════════════════════════════════════
   HERO
══════════════════════════════════════════ */
.hero {
    display: grid;
    /* FIX: minmax(0, 1fr) stops the columns from expanding to fit overflow content */
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    gap: 0;
    min-height: 500px;
    overflow: hidden;
    border-radius: var(--radius-lg);
    margin: 2.5rem 0 3rem;
    border: 0.5px solid rgba(0,0,0,0.1);
    box-shadow: 0 2px 20px rgba(0,0,0,0.06), 0 0 0 0.5px rgba(0,0,0,0.04);
}
.hero-left {
    background: linear-gradient(145deg, #017c80 0%, #01676d 100%);
    padding: 3.5rem 3rem;
    display: flex; flex-direction: column; justify-content: center;
    position: relative; overflow: hidden;
    min-width: 0; /* FIX: Allows column to compress properly */
}
.hero-left::before {
    content: '';
    position: absolute; top: -50px; right: -50px;
    width: 240px; height: 240px; border-radius: 50%;
    background: radial-gradient(circle, rgba(206,53,48,0.22) 0%, transparent 70%);
    pointer-events: none;
}
.hero-left::after {
    content: '';
    position: absolute; bottom: -70px; left: 20px;
    width: 180px; height: 180px; border-radius: 50%;
    background: rgba(255,255,255,0.04);
    pointer-events: none;
}.hero-left {
    /* Multi-stop gradient and large background size for a shifting effect */
    background: linear-gradient(135deg, #004b4e, #002d30, #00565a, #003236);
    background-size: 400% 400%;
    animation: heroGradientFlow 15s ease infinite;
    
    padding: 3.5rem 3rem;
    display: flex; flex-direction: column; justify-content: center;
    position: relative; overflow: hidden;
    min-width: 0;
}

/* Soft red warm light blob drifting organically */
.hero-left::before {
    content: '';
    position: absolute; 
    top: -50px; right: -50px;
    width: 260px; height: 260px; border-radius: 50%;
    background: radial-gradient(circle, rgba(206,53,48,0.28) 0%, transparent 70%);
    pointer-events: none;
    animation: driftBlobOne 20s ease-in-out infinite alternate;
}

/* Soft white cool light blob drifting organically */
.hero-left::after {
    content: '';
    position: absolute; 
    bottom: -70px; left: 20px;
    width: 200px; height: 200px; border-radius: 50%;
    background: rgba(255,255,255,0.05);
    pointer-events: none;
    animation: driftBlobTwo 16s ease-in-out infinite alternate;
}

/* ── ANIMATION KEYFRAMES ── */

/* Shifts the backdrop gradient colors smoothly */
@keyframes heroGradientFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Gently translates and scales the red glowing blob (GPU accelerated) */
@keyframes driftBlobOne {
    0% {
        transform: translate(0, 0) scale(1);
    }
    50% {
        transform: translate(-50px, 40px) scale(1.15);
    }
    100% {
        transform: translate(30px, -20px) scale(0.9);
    }
}

/* Gently translates and scales the white glowing blob (GPU accelerated) */
@keyframes driftBlobTwo {
    0% {
        transform: translate(0, 0) scale(1);
    }
    50% {
        transform: translate(40px, -50px) scale(1.12);
    }
    100% {
        transform: translate(-20px, 20px) scale(0.95);
    }
}
.hero-eyebrow {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: rgba(255,255,255,0.1);
    border: 0.5px solid rgba(255,255,255,0.2);
    color: rgba(255,255,255,0.7); border-radius: 20px;
    padding: 0.28rem 0.9rem; font-size: 0.7rem;
    font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;
    margin-bottom: 1.4rem; width: fit-content;
}
.hero-eyebrow::before { content: '✦'; font-size: 0.6rem; }
.hero-h1 {
    font-size: clamp(2.0rem, 4vw, 3.4rem);
    font-weight: 700; line-height: 1.08;
    color: var(--white); margin-bottom: 1.1rem; letter-spacing: -0.5px;
}
.hero-h1 span { color: #ff6b68; display: block; }
.hero-sub {
    color: rgba(255,255,255,0.55);
    font-size: 0.975rem; max-width: 320px; line-height: 1.65; margin-bottom: 2rem;
}
.hero-actions { display: flex; gap: 0.65rem; flex-wrap: wrap; }
.hero-actions .btn-primary {
    color: rgb(5,3,3); background: rgb(247,245,245);
    font-size: 0.875rem; font-weight: 700; padding: 0.65rem 1.5rem;
}
.hero-actions .btn-outline:hover {
    background: rgba(255, 255, 255, 0.12) !important;
    border-color: rgba(255, 255, 255, 0.6) !important;
    color: #fff !important;
}
.hero-right {
    background: rgba(255,255,255,0.88);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    display: flex; flex-direction: column;
    border-left: 0.5px solid rgba(0,0,0,0.08);
    min-width: 0; /* FIX: Allows column to compress properly */
}
.hero-search-panel {
    padding: 2.25rem 2.25rem 1.75rem;
    flex: 1; display: flex; flex-direction: column; justify-content: center;
}
.hero-search-panel h2 {
    font-size: 1.05rem; font-weight: 700; margin-bottom: 0.3rem;
    color: var(--teal); letter-spacing: -0.2px;
}
.hero-search-panel p { font-size: 0.83rem; color: #8e8e93; margin-bottom: 1.1rem; }
.hero-search-row { 
    display: flex; 
    gap: 0.5rem; 
    align-items: center;
    width: 100%;
}
.hero-search-row input {
    flex: 1; padding: 0.65rem 0.9rem;
    background: rgba(120,120,128,0.1);
    border: 0.5px solid rgba(0,0,0,0.1);
    border-radius: 10px; font-size: 0.875rem; color: var(--ink);
    outline: none; font-family: inherit;
    transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    min-width: 0; /* FIX: Keeps input box from overflowing its flex space */
}
.hero-search-row input:focus {
    border-color: var(--teal); background: var(--white);
    box-shadow: 0 0 0 3px rgba(0,75,78,0.08);
}
.hero-search-row .btn-teal {
    flex-shrink: 0;
}

/* ── CAROUSEL ── */
.hero-carousel {
    border-top: 0.5px solid rgba(0,0,0,0.08);
    padding: 1.1rem 1.35rem 1.2rem;
    background: rgba(249,249,251,0.7);
    overflow: hidden; flex-shrink: 0;
    width: 100%;
}
.hc-label {
    display: flex; align-items: center; gap: 0.45rem;
    font-size: 0.62rem; font-weight: 700; color: #8e8e93;
    text-transform: uppercase; letter-spacing: 0.1em;
    margin-bottom: 0.75rem; user-select: none;
}
.hc-live-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: var(--red); flex-shrink: 0;
    animation: hc-pulse 1.8s ease-in-out infinite;
}
@keyframes hc-pulse {
    0%,100% { opacity:1; transform:scale(1); }
    50%      { opacity:0.4; transform:scale(0.7); }
}
.hc-window { 
    overflow: hidden; 
    border-radius: 12px; 
    margin-bottom: 0.75rem; 
    width: 100%;
    position: relative;
}
.hc-track {
    display: flex;
    transition: transform 0.5s cubic-bezier(.25,.8,.25,1);
    will-change: transform;
    width: 100%;
}
.hc-slide {
    flex: 0 0 100%;
    width: 100%;
    box-sizing: border-box;
    display: flex; align-items: center; gap: 0.85rem;
    background: var(--ghost); border-radius: 12px;
    padding: 0.8rem 0.9rem;
    position: relative; cursor: pointer;
    transition: background 0.2s;
}
.hc-slide:hover { background: #ebebf0; }
.hc-img {
    width: 56px; height: 56px; flex-shrink: 0;
    border-radius: 9px; overflow: hidden;
    background: #fff; border: 0.5px solid rgba(0,0,0,0.07);
    display: flex; align-items: center; justify-content: center;
}
.hc-img img { width:100%; height:100%; object-fit:cover; display:block; }
.hc-img svg { color: #c7c7cc; }
.hc-info {
    display: flex; flex-direction: column; gap: 0.15rem;
    flex: 1; min-width: 0; overflow: hidden;
    padding-right: 85px; /* FIX: Keeps product text from overlapping absolute badge */
}
.hc-brand { font-size: 0.6rem; font-weight: 700; color: var(--red); text-transform: uppercase; letter-spacing: 0.1em; }
.hc-name {
    font-size: 0.875rem; font-weight: 700; color: var(--ink);
    line-height: 1.25; letter-spacing: -0.15px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.hc-price { font-size: 0.92rem; font-weight: 700; color: var(--teal); letter-spacing: -0.2px; }
.hc-badge {
    position: absolute; top: 50%; transform: translateY(-50%); right: 0.9rem;
    font-size: 0.58rem; font-weight: 700; padding: 0.25rem 0.6rem;
    border-radius: 20px; text-transform: uppercase; letter-spacing: 0.05em; pointer-events: none;
}
.hc-badge-in  { background: rgba(0,168,118,0.12); color: #007a56; }
.hc-badge-low { background: #fff3cd; color: #92400e; }
.hc-badge-out { background: rgba(206,53,48,0.1); color: var(--red); }
.hc-link { position:absolute; inset:0; z-index:2; border-radius:12px; }
.hc-footer { display:flex; align-items:center; justify-content:space-between; }
.hc-dots { display:flex; align-items:center; gap:0.3rem; }
.hc-dot-btn {
    width: 6px; height: 6px; border-radius: 3px;
    background: rgba(0,0,0,0.15); border: none; cursor: pointer;
    padding: 0; transition: all 0.28s ease; flex-shrink: 0;
}
.hc-dot-btn.active { background: var(--teal); width: 18px; }
.hc-arrows { display:flex; gap:0.35rem; }
.hc-arrow {
    width: 26px; height: 26px; border-radius: 50%;
    background: rgba(255,255,255,0.9); border: 0.5px solid rgba(0,0,0,0.1);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--ink);
    transition: background 0.15s, transform 0.15s, box-shadow 0.15s;
    box-shadow: 0 1px 4px rgba(0,0,0,0.07);
}
.hc-arrow:hover { background: #fff; box-shadow: 0 3px 10px rgba(0,0,0,0.12); transform: scale(1.1); }

/* ── REST OF PAGE ── */
.section-label { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem; }
.section-label h2 { font-size: 1.4rem; font-weight: 700; color: var(--ink); letter-spacing: -0.3px; }
.section-label a {
    margin-left: auto; font-size: 0.8rem; color: var(--red);
    text-decoration: none; font-weight: 600;
    display: flex; align-items: center; gap: 0.3rem; transition: gap 0.2s;
}
.section-label a:hover { gap: 0.55rem; }
.section-divider { width: 24px; height: 3px; border-radius: 2px; background: var(--red); margin-bottom: 1.25rem; }
.cat-icon {
    /* Increased size from 52px to 80px to fill the box better */
    width: 80px; 
    height: 80px;
    border-radius: 16px;
    background: rgba(0,75,78,0.06); 
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    transition: all 0.3s ease;
}

.cat-icon img {
    /* Makes the image fill almost the entire 80px area */
    width: 100%;
    height: 100%;
    object-fit: contain; /* 'contain' ensures you see the whole icon clearly */
    padding: 5px; /* Adds a tiny bit of space so it doesn't touch the edges */
}

/* Optional: Make the image pop even more when hovering the card */
.cat-card:hover .cat-icon img {
    transform: scale(1.1);
}
.cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 0.875rem; margin-bottom: 3.5rem;
}
.cat-card {
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
    border: 0.5px solid rgba(0,0,0,0.08); border-radius: var(--radius-lg);
    padding: 1.4rem 1.1rem 1.1rem;
    text-align: center; text-decoration: none; color: inherit;
    display: flex; flex-direction: column; align-items: center;
    transition: transform 0.25s var(--spring), box-shadow 0.25s, border-color 0.25s;
    position: relative; overflow: hidden;
}
.cat-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2.5px;
    background: var(--red); transform: scaleX(0); transform-origin: left;
    transition: transform 0.3s ease;
}
.cat-card:hover {
    border-color: rgba(0,75,78,0.18);
    box-shadow: 0 8px 24px rgba(0,75,78,0.1), 0 2px 6px rgba(0,0,0,0.05);
    transform: translateY(-5px) scale(1.01);
}
.cat-card:hover::before { transform: scaleX(1); }

.cat-name { font-weight: 700; font-size: 0.875rem; color: var(--ink); line-height: 1.3; letter-spacing: -0.15px; }
.cat-count { font-size: 0.7rem; color: #8e8e93; margin-top: 0.2rem; }

.products-section { margin-bottom: 3.5rem; }

.promo-banner {
    background: linear-gradient(135deg, #ce3530 0%, #a32420 100%);
    border-radius: var(--radius-lg); padding: 2.25rem 2.75rem;
    display: flex; align-items: center; justify-content: space-between;
    gap: 2rem; margin-bottom: 3.5rem; position: relative; overflow: hidden;
    border: 0.5px solid rgba(255,255,255,0.12);
    box-shadow: 0 4px 28px rgba(206,53,48,0.28), 0 1px 4px rgba(0,0,0,0.08);
}
.promo-banner::before {
    content: ''; position: absolute; top: -40px; right: 220px;
    width: 180px; height: 180px; border-radius: 50%;
    background: rgba(255,255,255,0.07); pointer-events: none;
}
.promo-banner::after {
    content: ''; position: absolute; bottom: -55px; right: -25px;
    width: 220px; height: 220px; border-radius: 50%;
    background: rgba(0,75,78,0.15); pointer-events: none;
}
.promo-text h3 {
    font-size: 1.5rem; font-weight: 700; color: var(--white);
    line-height: 1.2; margin-bottom: 0.4rem; letter-spacing: -0.3px;
}
.promo-text p { color: rgba(255,255,255,0.65); font-size: 0.875rem; }
.promo-cta {
    background: rgba(255,255,255,0.15); backdrop-filter: blur(12px);
    border: 0.5px solid rgba(255,255,255,0.3); color: var(--white);
    padding: 0.68rem 1.6rem; border-radius: 20px; font-size: 0.875rem; font-weight: 700;
    text-decoration: none; font-family: inherit; white-space: nowrap; flex-shrink: 0;
    transition: background 0.2s, transform 0.2s; position: relative; z-index: 1;
}
.promo-cta:hover { background: rgba(255,255,255,0.25); transform: scale(1.03); }

@media (max-width: 900px) {
    .hero { grid-template-columns: 1fr; min-height: auto; }
    .hero-right { border-left: none; border-top: 0.5px solid rgba(0,0,0,0.08); }
    .hero-left { padding: 2.75rem 1.75rem; }
    .promo-banner { flex-direction: column; text-align: center; padding: 1.75rem 1.5rem; }
    .cat-grid { grid-template-columns: repeat(auto-fill, minmax(135px, 1fr)); }
    
    /* FIX: Stacks the heading and the "See all categories" link vertically so they do not wrap awkwardly */
    .section-label {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    .section-label a {
        margin-left: 0;
        margin-top: 0.25rem;
    }
}
</style>
@endpush

@section('content')

{{-- ══ HERO ══ --}}
<section class="hero">
    <div class="hero-left">
        <div class="hero-eyebrow">In-Store Digital Catalog</div>
        <h1 class="hero-h1">
            Set The Mood.<br>
            <span>Build Your Setup.</span>
        </h1>
        <p class="hero-sub">Browse our full product range, compare specs, and find exactly what fits your space all at your own pace.</p>
        <div class="hero-actions">
            <a href="{{ route('search') }}" class="btn btn-primary">Browse All Products</a>
            <a href="{{ route('matcher') }}" class="btn btn-outline"
               style="color:rgba(255,255,255,0.8);border-color:rgba(255,255,255,0.25);">
                Help me build my setup →
            </a>
        </div>
    </div>


    <div class="hero-right">
        <div class="hero-search-panel">
            <h2>Find What You Need</h2>
            <p>Search by product name, brand, or category</p>
            <form action="{{ route('search') }}" method="GET" class="hero-search-row">
                <input type="text" name="q"
                       placeholder="e.g. monitor, keyboard, chair…"
                       value="{{ request('q') }}">
                <button class="btn btn-teal">Search</button>
            </form>
        </div>

        <div class="hero-carousel" id="heroCarousel">
            <div class="hc-label">
                <span class="hc-live-dot"></span>
                Trending in store right now
            </div>

            <div class="hc-window">
                <div class="hc-track" id="hcTrack">
                    @foreach($featuredProducts->take(8) as $product)
                    <div class="hc-slide">
                        <div class="hc-img">
                            @if($product->product_image)
                                @php
                                    $img = $product->product_image;
                                    // Check if it's a web link or a local file
                                    $isUrl = Str::startsWith($img, ['http://', 'https://']);
                                    // If it's local, we use asset() directly (without 'storage/')
                                    $finalPath = $isUrl ? $img : asset($img);
                                @endphp
                                <img 
                                    src="{{ $finalPath }}" 
                                    alt="{{ $product->product_name }}" 
                                    loading="lazy"
                                    onerror="this.onerror=null; this.src='{{ asset('products/placeholder.jpg') }}';"
                                >
                            @else
                                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24">
                                    <rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>
                                </svg>
                            @endif
                        </div>
                        <div class="hc-info">
                            <span class="hc-brand">{{ $product->brand ?? $product->category->category_name ?? '' }}</span>
                            <span class="hc-name">{{ Str::limit($product->product_name, 30) }}</span>
                            <span class="hc-price">${{ number_format($product->price, 2) }}</span>
                        </div>
                        @if($product->stock_quantity <= 0)
                            <span class="hc-badge hc-badge-out">Out of stock</span>
                        @elseif($product->stock_quantity <= ($product->stock_threshold ?? 5))
                            <span class="hc-badge hc-badge-low">Only {{ $product->stock_quantity }} left</span>
                        @else
                            <span class="hc-badge hc-badge-in">In stock</span>
                        @endif
                        <a href="{{ route('product.show', $product) }}" class="hc-link"
                           aria-label="View {{ $product->product_name }}"></a>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="hc-footer">
                <div class="hc-dots" id="hcDots">
                    @foreach($featuredProducts->take(8) as $i => $product)
                        <button class="hc-dot-btn {{ $i === 0 ? 'active' : '' }}"
                                data-index="{{ $i }}"
                                aria-label="Go to slide {{ $i + 1 }}"></button>
                    @endforeach
                </div>
                <div class="hc-arrows">
                    <button class="hc-arrow" id="hcPrev" aria-label="Previous">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                    </button>
                    <button class="hc-arrow" id="hcNext" aria-label="Next">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="9 18 15 12 9 6"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>{{-- /hero-carousel --}}

    </div>{{-- /hero-right --}}
</section>{{-- /hero --}}

{{-- ══ CATEGORIES ══ --}}
<section style="margin-bottom:4rem;">
    <div class="section-label">
        <div>
            <div class="section-divider"></div>
            <h2>Browse by Category</h2>
        </div>
        <a href="{{ route('search') }}">See all categories →</a>
    </div>
    <div class="cat-grid">
    @foreach($categories as $cat)
    <a href="{{ route('category.show', $cat) }}" class="cat-card">
        <div class="cat-icon">
            @if($cat->category_image)
                @php
                    $cImg = $cat->category_image;
                    $isCUrl = Str::startsWith($cImg, ['http://', 'https://']);
                    $finalCPath = $isCUrl ? $cImg : asset($cImg);
                @endphp
                <img src="{{ $finalCPath }}" alt="{{ $cat->category_name }}" 
                     onerror="this.src='{{ asset('products/placeholder.jpg') }}'">
            @else
                <svg width="32" height="32" fill="none" stroke="var(--teal)" stroke-width="1.5" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>
                </svg>
            @endif
        </div>
        <p class="cat-name">{{ $cat->category_name }}</p>
        <p class="cat-count">{{ $cat->products_count }} products</p>
    </a>
    @endforeach
</div>
</section>

{{-- ══ PROMO BANNER ══ --}}
<div class="promo-banner">
    <div class="promo-text">
        <h3>Not sure what to pick?<br>Our staff will walk you through it.</h3>
        <p>Ask any in-store associate for a hands-on demo of any product in our catalog.</p>
    </div>
    <a href="{{ route('faq') }}" class="promo-cta">Learn More →</a>
</div>

{{-- ══ FEATURED PRODUCTS ══ --}}
<section class="products-section">
    <div class="section-label">
        <div>
            <div class="section-divider"></div>
            <h2>Featured Products</h2>
        </div>
        <a href="{{ route('search') }}">View all →</a>
    </div>
    <div class="product-grid">
        @foreach($featuredProducts as $product)
            @include('partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    const track  = document.getElementById('hcTrack');
    const dots   = document.querySelectorAll('#hcDots .hc-dot-btn');
    const total  = dots.length;
    if (!track || total === 0) return;

    let current = 0;
    let paused  = false;
    let timer;

    function goTo(idx) {
        current = ((idx % total) + total) % total;
        track.style.transform = 'translateX(-' + (current * 100) + '%)';
        dots.forEach(function(d, i) { d.classList.toggle('active', i === current); });
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function startAuto() {
        clearInterval(timer);
        timer = setInterval(function() { if (!paused) next(); }, 3200);
    }

    dots.forEach(function(d) {
        d.addEventListener('click', function() { goTo(+d.dataset.index); startAuto(); });
    });

    document.getElementById('hcNext').addEventListener('click', function() { next(); startAuto(); });
    document.getElementById('hcPrev').addEventListener('click', function() { prev(); startAuto(); });

    var carousel = document.getElementById('heroCarousel');
    carousel.addEventListener('mouseenter', function() { paused = true; });
    carousel.addEventListener('mouseleave', function() { paused = false; });

    var tx = 0;
    carousel.addEventListener('touchstart', function(e) { tx = e.touches[0].clientX; }, { passive: true });
    carousel.addEventListener('touchend', function(e) {
        var diff = tx - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) { diff > 0 ? next() : prev(); startAuto(); }
    });

    carousel.setAttribute('tabindex', '0');
    carousel.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowRight') { next(); startAuto(); }
        if (e.key === 'ArrowLeft')  { prev(); startAuto(); }
    });

    startAuto();
})();
</script>
@endpush