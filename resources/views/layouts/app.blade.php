<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mood Set-up Studio — Digital Catalog')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Space+Grotesque:wght@300;500;700&family=DM+Sans:opsz,wght@0,9..40,400;0,9..40,500&display=swap" rel="stylesheet">
    <style>
       :root {
    --red:       #ce3530;
    --red-dark:  #a32420;
    --red-pale:  #fdf1f0;
    --teal:      #004b4e;
    --teal-mid:  #006b6f;
    --teal-pale: #e6f4f4;
    --ink:       #1c1c1e;
    --ink-2:     #3a3a3c;
    --ghost:     #f2f2f7;
    --line:      rgba(0,0,0,0.08);
    --white:     #ffffff;
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 20px;
    --spring:    cubic-bezier(.34,1.56,.64,1);
    --ease:      cubic-bezier(.25,.8,.25,1);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Inter', 'DM Sans', sans-serif;
    background: var(--ghost);
    color: var(--ink);
    min-height: 100vh;
    line-height: 1.6;
}
h1, h2, h3, h4, h5 {
    font-family: 'Space Grotesque', -apple-system, BlinkMacSystemFont, sans-serif;
    letter-spacing: -0.3px;
}

/* ── NAV ── */
nav {
    position: sticky; top: 0; z-index: 200;
    background: rgba(255,255,255,0.72);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border-bottom: 0.5px solid rgba(0,0,0,0.12);
}
.nav-inner {
    max-width: 1320px; margin: auto;
    display: flex; align-items: center; gap: 2rem;
    height: 64px; padding: 0 2.5rem;
}
.nav-logo {
    font-weight: 700; font-size: 1.1rem;
    color: var(--teal); text-decoration: none;
    display: flex; align-items: center; gap: 0;
    white-space: nowrap; letter-spacing: -0.3px;
}
.nav-logo em {
    font-style: normal; color: var(--red);
    position: relative; display: inline-block;
}
.nav-logo em::after {
    content: '';
    position: absolute; bottom: -2px; left: 0; right: 0; height: 1.5px;
    background: var(--red); border-radius: 2px;
}

.nav-search {
    flex: 1; position: relative; max-width: 400px;
}
.nav-search input {
    width: 100%; padding: 0.5rem 1rem 0.5rem 2.4rem;
    background: rgba(120,120,128,0.12);
    border: none;
    border-radius: 10px;
    color: var(--ink); font-size: 0.875rem;
    outline: none;
    transition: background 0.2s;
    font-family: inherit;
}
.nav-search input:focus { background: rgba(120,120,128,0.18); }
.nav-search input::placeholder { color: #8e8e93; }
.nav-search svg {
    position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);
    color: #8e8e93; pointer-events: none;
}

.nav-links { margin-left: auto; display: flex; align-items: center; gap: 0.25rem; }
.nav-links a {
    color: var(--ink-2); text-decoration: none; font-size: 0.875rem; font-weight: 500;
    padding: 0.4rem 0.75rem; border-radius: 8px;
    transition: color 0.15s, background 0.15s;
}
.nav-links a.active {
    color: var(--teal);
    background: var(--teal-pale);
    font-weight: 600;
}
.nav-links .btn-pill {
    color: var(--white) !important;
}

.btn-pill {
    background: var(--teal); color: var(--white);
    border: none; border-radius: 20px;
    padding: 0.5rem 1.25rem; font-size: 0.85rem; font-weight: 600;
    cursor: pointer; text-decoration: none;
    transition: background 0.2s, transform 0.15s;
    font-family: inherit; letter-spacing: -0.2px;
}
.btn-pill:hover { background: var(--teal-mid); transform: scale(1.02); }
.btn-pill-red { background: var(--red); }
.btn-pill-red:hover { background: var(--red-dark); }

/* ── LAYOUT ── */
.container { max-width: 1320px; margin: auto; padding: 0 2.5rem; }
main { padding: 0 0 5rem; }

/* ── FLASH ── */
.flash {
    padding: 0.8rem 1.25rem; border-radius: var(--radius-md); margin-bottom: 1.5rem;
    font-size: 0.875rem; border-left: 3px solid;
}
.flash.success { background: rgba(0,168,118,0.08); border-color: #00a876; color: #007a56; }
.flash.error   { background: var(--red-pale); border-color: var(--red); color: var(--red-dark); }

/* ── CARDS ── */
.card {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 0.5px solid rgba(0,0,0,0.08);
    border-radius: var(--radius-lg);
    overflow: hidden;
    transition: border-color 0.25s, box-shadow 0.25s, transform 0.25s var(--spring);
}
.card:hover {
    border-color: rgba(0,75,78,0.2);
    box-shadow: 0 12px 32px rgba(0,75,78,0.12), 0 2px 8px rgba(0,0,0,0.05);
    transform: translateY(-4px) scale(1.005);
}

/* ── PRODUCT GRID ── */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 1.25rem;
}

/* ── PRODUCT CARD ── */
.product-card { position: relative; cursor: pointer; }
.product-card .img-wrap {
    aspect-ratio: 1; overflow: hidden; background: var(--ghost);
}
.product-card img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s var(--ease);
}
.product-card:hover img { transform: scale(1.07); }
.product-card .info { padding: 1rem 1.1rem 1.2rem; }
.product-card .brand {
    font-size: 0.68rem; color: var(--red); text-transform: uppercase;
    letter-spacing: 0.1em; font-weight: 700;
}
.product-card .name {
    font-weight: 700; font-size: 0.975rem;
    margin: 0.2rem 0 0.4rem; line-height: 1.3;
    letter-spacing: -0.2px;
}
.product-card .price {
    font-size: 1.15rem; font-weight: 700; color: var(--teal);
    letter-spacing: -0.3px;
}
.badge-oos {
    position: absolute; top: 0.75rem; left: 0.75rem;
    background: rgba(28,28,30,0.75);
    backdrop-filter: blur(8px);
    color: var(--white);
    font-size: 0.63rem; font-weight: 700; padding: 0.22rem 0.6rem;
    border-radius: 20px; text-transform: uppercase; letter-spacing: 0.06em;
}
.badge-new {
    background: rgba(206,53,48,0.85);
    backdrop-filter: blur(8px);
    color: var(--white);
}

/* ── COMPARE ── */
.compare-check {
    position: absolute; top: 0.75rem; right: 0.75rem;
    background: rgba(255,255,255,0.75);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 0.5px solid rgba(0,0,0,0.1);
    border-radius: 20px; padding: 0.28rem 0.65rem;
    font-size: 0.68rem; font-weight: 600; color: var(--ink-2);
    cursor: pointer; display: flex; align-items: center; gap: 0.3rem;
    transition: all 0.2s;
}
.compare-check:hover, .compare-check.active {
    border-color: var(--red); color: var(--red);
    background: rgba(255,255,255,0.92);
}
.compare-bar {
    position: fixed; bottom: 2rem; left: 50%; transform: translateX(-50%);
    background: rgba(0,75,78,0.92);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 0.7rem 1.5rem;
    display: flex; align-items: center; gap: 1.25rem;
    box-shadow: 0 16px 48px rgba(0,75,78,0.35);
    z-index: 300; animation: slideUp 0.3s var(--spring);
    border: 0.5px solid rgba(255,255,255,0.15);
}
.compare-bar span { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
.compare-bar a {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    border: 0.5px solid rgba(255,255,255,0.25);
    color: var(--white);
    padding: 0.38rem 1rem; border-radius: 20px;
    font-size: 0.78rem; font-weight: 700; text-decoration: none;
    transition: background 0.2s;
}
.compare-bar a:hover { background: rgba(255,255,255,0.25); }
.compare-bar button {
    background: none; border: none; color: rgba(255,255,255,0.5);
    cursor: pointer; font-size: 1.1rem; line-height: 1;
    transition: color 0.15s;
}
.compare-bar button:hover { color: rgba(255,255,255,0.9); }
@keyframes slideUp { from { transform: translateX(-50%) translateY(16px); opacity: 0; } }

/* ── BUTTONS ── */
.btn {
    display: inline-flex; align-items: center; gap: 0.4rem;
    padding: 0.58rem 1.2rem; border-radius: 20px; border: 0.5px solid transparent;
    font-size: 0.875rem; font-weight: 600; cursor: pointer;
    text-decoration: none; transition: all 0.2s;
    font-family: inherit; letter-spacing: -0.1px;
}
.btn-primary  { background: var(--red); color: var(--white); border-color: var(--red); }
.btn-primary:hover { background: var(--red-dark); transform: scale(1.02); }
.btn-teal     { background: var(--teal); color: var(--white); border-color: var(--teal); }
.btn-teal:hover { background: var(--teal-mid); transform: scale(1.02); }
.btn-outline  {
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(8px);
    border-color: rgba(0,0,0,0.1); color: var(--ink);
}
.btn-outline:hover { border-color: rgba(0,75,78,0.3); color: var(--teal); background: rgba(245, 212, 212, 0.58); }
.btn-danger   { background: var(--red); color: var(--white); border-color: var(--red); }
.btn-danger:hover { opacity: 0.88; transform: scale(1.01); }
.btn-sm       { padding: 0.32rem 0.85rem; font-size: 0.775rem; border-radius: 8px; }

/* ── FORMS ── */
.form-group { margin-bottom: 1.25rem; }
.form-group label {
    display: block; font-size: 0.82rem; color: var(--ink-2);
    font-weight: 500; margin-bottom: 0.4rem;
}
.form-control {
    width: 100%; padding: 0.68rem 1rem;
    background: rgba(255,255,255,0.9);
    border: 0.5px solid rgba(0,0,0,0.12);
    border-radius: var(--radius-md); color: var(--ink); font-size: 0.9rem;
    outline: none; transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    font-family: inherit;
}
.form-control:focus {
    border-color: var(--teal);
    background: var(--white);
    box-shadow: 0 0 0 3px rgba(0,75,78,0.1);
}
textarea.form-control { resize: vertical; min-height: 110px; }
.form-error { color: var(--red); font-size: 0.78rem; margin-top: 0.3rem; }

/* ── TABLE ── */
table { width: 100%; border-collapse: collapse; }
th, td { padding: 0.875rem 1rem; text-align: left; border-bottom: 0.5px solid rgba(0,0,0,0.07); }
th {
    font-size: 0.7rem; color: #8e8e93; text-transform: uppercase;
    letter-spacing: 0.07em; font-weight: 600;
}
tr:last-child td { border-bottom: none; }
tbody tr { transition: background 0.15s; }
tbody tr:hover { background: rgba(0,75,78,0.03); }

/* ── PAGE HEADER ── */
.page-header { margin-bottom: 2rem; }
.page-header h1 { font-size: 1.9rem; font-weight: 700; letter-spacing: -0.5px; }
.page-header p { color: var(--ink-2); margin-top: 0.35rem; }

/* ── CHIPS ── */
.chip {
    display: inline-flex; align-items: center;
    padding: 0.22rem 0.7rem; border-radius: 20px;
    font-size: 0.7rem; font-weight: 700; letter-spacing: 0.03em; text-transform: uppercase;
}
.chip-green  { background: rgba(0,168,118,0.1); color: #007a56; }
.chip-red    { background: rgba(206,53,48,0.1); color: var(--red); }
.chip-teal   { background: rgba(0,75,78,0.1); color: var(--teal); }

/* ── TICKER ── */
.ticker-wrap {
    overflow: hidden;
    background: var(--teal);
    padding: 0.6rem 0;
    margin: 0 2.5rem;
    border-radius: 12px;
}
.ticker-track {
    display: flex; gap: 3rem; width: max-content;
    animation: ticker 28s linear infinite;
}
.ticker-track span {
    font-size: 0.75rem; font-weight: 700;
    color: rgba(255,255,255,0.5); text-transform: uppercase;
    letter-spacing: 0.1em; white-space: nowrap;
}
.ticker-track span em { color: var(--white); font-style: normal; }
@keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

/* ── FOOTER ── */
footer {
    border-top: 0.5px solid rgba(0,0,0,0.08);
    padding: 2rem 2.5rem;
    text-align: center;
    color: #8e8e93;
    font-size: 0.82rem;
    background: rgba(255,255,255,0.5);
}
footer strong { color: var(--teal); font-weight: 600; }

@media (max-width: 768px) {
    .nav-search { display: none; }
    .product-grid { grid-template-columns: repeat(auto-fill, minmax(155px, 1fr)); gap: 0.875rem; }
    
    /* FIX: Stacks the logo and links vertically on mobile to prevent squishing and overflow */
    .nav-inner { 
        flex-direction: column;
        height: auto;
        padding: 0.75rem 1.25rem; 
        gap: 0.75rem; 
        align-items: flex-start;
    }
    
    /* FIX: Enables clean, smooth horizontal swiping for the navigation links on mobile */
    .nav-links { 
        margin-left: 0;
        width: 100%;
        overflow-x: auto;
        white-space: nowrap;
        display: flex;
        gap: 0.5rem;
        padding-bottom: 4px;
        scrollbar-width: none; /* Hides horizontal scrollbar on Firefox */
        -webkit-overflow-scrolling: touch;
    }
    .nav-links::-webkit-scrollbar {
        display: none; /* Hides horizontal scrollbar on Chrome/Safari */
    }
    .nav-links a, .nav-links form, .nav-links button {
        flex-shrink: 0; /* Stops buttons from compressing/shrinking */
    }

    .container { padding: 0 1.25rem; }
    .ticker-wrap { margin: 0 1.25rem; }
}
    </style>
    @stack('styles')
</head>
<body>

<nav>
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-logo">
            Mood&nbsp;Set-up&nbsp;<em>Studio</em>
        </a>
        <form class="nav-search" action="{{ route('search') }}" method="GET">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <input type="text" name="q" placeholder="Search products, brands…" value="{{ request('q') }}">
        </form>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('search') }}" class="{{ request()->routeIs('search') ? 'active' : '' }}">Browse</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>

            @auth
                @if(auth()->user()->is_admin) 
                    <a href="{{ route('admin.dashboard') }}" class="btn-pill">Admin Panel</a>
                @endif

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-sm">Logout</button>
                </form>
            @endauth
        </div>
    </div> <!-- FIX: Closes the .nav-inner container -->
</nav>

<div class="container">
    <main>
        @if(session('success'))
            <div class="flash success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</div>

{{-- TICKER --}}
<div class="ticker-wrap">
    <div class="ticker-track" id="tickerTrack">
        <span>Free In-Store Browsing</span>
        <span><em>✦</em></span>
        <span>Compare Up to <em>3 Products</em></span>
        <span><em>✦</em></span>
        <span>Ask Staff for a Demo</span>
        <span><em>✦</em></span>
        <span>New Arrivals Weekly</span>
        <span><em>✦</em></span>
        <span>Exclusive Studio Bundles</span>
        <span><em>✦</em></span>
        <span>Free In-Store Browsing</span>
        <span><em>✦</em></span>
        <span>Compare Up to <em>3 Products</em></span>
        <span><em>✦</em></span>
        <span>Ask Staff for a Demo</span>
        <span><em>✦</em></span>
        <span>New Arrivals Weekly</span>
        <span><em>✦</em></span>
        <span>Exclusive Studio Bundles</span>
        <span><em>✦</em></span>
    </div>
</div>

<footer>
    <p><strong>Mood Set-up Studio</strong> Digital Catalog &copy; {{ date('Y') }}</p>
</footer>

<script>
// ── COMPARE FEATURE ──────────────────────────────────────────────────────────
let compareItems = JSON.parse(localStorage.getItem('compare') || '[]')
                       .map(String);
let compareBar = null;
 
function toggleCompare(rawId) {
    const id  = String(rawId);
    const idx = compareItems.indexOf(id);
 
    if (idx > -1) {
        compareItems.splice(idx, 1);
    } else {
        if (compareItems.length >= 3) {
            alert('You can compare up to 3 products at a time.');
            return;
        }
        compareItems.push(id);
    }
 
    localStorage.setItem('compare', JSON.stringify(compareItems));
    updateCompareUI();
}
 
function updateCompareUI() {
    document.querySelectorAll('.compare-check').forEach(el => {
        const id = String(el.dataset.id);
        const active = compareItems.includes(id);
        el.classList.toggle('active', active);
 
        const label = el.querySelector('.compare-label');
        if (label) label.textContent = active ? 'Added ✓' : 'Compare';
    });
 
    if (compareItems.length > 0) {
        if (!compareBar) {
            compareBar = document.createElement('div');
            compareBar.className = 'compare-bar';
            document.body.appendChild(compareBar);
        }
        compareBar.innerHTML = `
            <span>${compareItems.length} of 3 selected</span>
            <a href="/compare?ids=${compareItems.join(',')}" 
               ${compareItems.length < 2 ? 'style="opacity:.5;pointer-events:none;"' : ''}>
               Compare Now →
            </a>
            <button onclick="clearCompare()" aria-label="Clear compare">✕</button>
        `;
    } else if (compareBar) {
        compareBar.remove();
        compareBar = null;
    }
}
 
function clearCompare() {
    compareItems = [];
    localStorage.setItem('compare', JSON.stringify(compareItems));
    updateCompareUI();
}
 
document.addEventListener('DOMContentLoaded', updateCompareUI);
</script>
@stack('scripts')
</body>
</html>