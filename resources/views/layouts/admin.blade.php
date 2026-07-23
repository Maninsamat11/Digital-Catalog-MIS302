<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — Mood Set-up Studio')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesque:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-w: 240px;
            --red:       #ce3530;
            --red-dark:  #a32420;
            --red-pale:  #fdf1f0;
            --teal:      #004b4e;
            --teal-mid:  #006b6f;
            --teal-pale: #e6f4f4;
            --ink:       #111115;
            --ink-2:     #3e3e46;
            --ghost:     #f4f4f7;
            --line:      rgba(0, 0, 0, 0.06);
            --white:     #ffffff;
            --success:   #00875a;
            --danger:    #de350b;
            --warn:      #b45309;
            --spring:    cubic-bezier(.34,1.56,.64,1);
            --ease:      cubic-bezier(.25,.8,.25,1);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--ghost);
            color: var(--ink);
            display: flex;
            min-height: 100vh;
        }
        h1,h2,h3,h4,h5 { 
            font-family: 'Space Grotesque', sans-serif; 
            letter-spacing: -0.3px; 
            font-weight: 600;
        }

        
        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w); flex-shrink: 0;
            background: var(--teal);

            display: flex; flex-direction: column;
            position: fixed; height: 100vh; top: 0; left: 0;
            z-index: 50;
            border-right: 1px solid rgba(255, 255, 255, 0.04);
        }
        .sidebar-logo {
            padding: 1.6rem 1.5rem 1.4rem;
            border-bottom: 1px solid rgba(255,255,255,0.04);
        }
        .sidebar-logo a {
            font-weight: 700; font-size: 1.05rem;
            color: var(--white); text-decoration: none;
            display: block; line-height: 1.2; letter-spacing: -0.4px;
            font-family: 'Space Grotesque', sans-serif;
        }
        .sidebar-logo a em { font-style: normal; color: #ff6b68; }
        .sidebar-logo p {
            font-size: 0.6rem; color: rgba(255,255,255,0.4);
            margin-top: 0.3rem; text-transform: uppercase;
            letter-spacing: 0.15em; font-weight: 700;
        }

        .sidebar-nav { padding: 1.25rem 0.75rem; flex: 1; overflow-y: auto; }
        .nav-label {
            font-size: 0.58rem; text-transform: uppercase; letter-spacing: 0.15em;
            color: rgba(255,255,255,0.25); padding: 0.75rem 0.75rem 0.35rem;
            margin-top: 0.5rem; font-weight: 700;
        }
        .sidebar-nav a {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.6rem 0.75rem; border-radius: 6px;
            color: rgba(255,255,255,0.5); text-decoration: none; font-size: 0.82rem;
            font-weight: 500;
            transition: all 0.15s; margin-bottom: 0.15rem;
        }
        .sidebar-nav a:hover {
            background: rgba(255,255,255,0.04); color: var(--white);
        }
        /* Minimalist Active Tab with glowing left edge marker */
        .sidebar-nav a.active {
            background: rgba(255,255,255,0.05); color: var(--white);
            border-left: 3px solid var(--red);
            border-radius: 0 6px 6px 0;
            padding-left: calc(0.75rem - 3px);
            font-weight: 600;
        }
        .sidebar-nav svg { flex-shrink: 0; opacity: 0.65; }
        .sidebar-nav a.active svg { opacity: 1; color: var(--white); }

        .sidebar-footer {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.04);
            background: rgba(0,0,0,0.1);
        }
        .sidebar-footer .user-name {
            font-size: 0.78rem; font-weight: 600; color: var(--white);
            margin-bottom: 0.2rem; letter-spacing: -0.1px;
        }
        .sidebar-footer button {
            background: none; border: none; color: rgba(255,255,255,0.4);
            cursor: pointer; font-size: 0.72rem; padding: 0;
            transition: color 0.15s; font-family: inherit; font-weight: 500;
        }
        .sidebar-footer button:hover { color: #ff6b68; }

        /* ── MAIN WRAP ── */
        .main-wrap {
            margin-left: var(--sidebar-w); flex: 1;
            display: flex; flex-direction: column; min-height: 100vh;
        }
 @media (max-width: 1024px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr) !important; /* 2 columns for tablets */
        gap: 1rem;
    }
}

@media (max-width: 600px) {
    .stats-grid {
        grid-template-columns: 1fr !important; /* 1 column for phones (Stacking) */
    }
    
    /* 2. Fix the two-column sections below (Restock Alerts / Quick Actions) */
    .grid-2 {
        grid-template-columns: 1fr !important; /* Stack them 1 by 1 */
        gap: 1.25rem;
    }

    /* 3. Fix internal padding so buttons don't hit the edges */
    .card-body {
        padding: 1.25rem !important;
    }

    /* 4. Fix the "Bulk CSV Import" row so the button doesn't overflow */
    .quick-action-row {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.75rem;
    }
    
    .quick-action-row .btn {
        width: 100%; /* Make buttons full width on phone */
        justify-content: center;
    }
}/* 📱 MOBILE VIEWPORT FIXES */

@media (max-width: 992px) {
    /* 1. Remove the fixed margin so content fills the screen width */
    .main-wrap {
        margin-left: 0;
    }

    /* 2. Fix Top Stats: Change from 4 columns to 2 columns for tablets */
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    /* 3. Hide sidebar by default on mobile (requires the hamburger menu button) */
    .sidebar {
        transform: translateX(-100%);
    }
}

@media (max-width: 600px) {
    /* 4. Fix Top Stats: Change from 2 columns to 1 column for phones */
    .stats-grid {
        grid-template-columns: 1fr;
    }

    /* 5. Fix Dashboard Sections: Change .grid-2 from 2 columns to 1 column */
    .grid-2 {
        grid-template-columns: 1fr;
    }

    /* 6. Adjust Topbar padding for smaller screens */
    .topbar {
        padding: 0 1rem;
    }

    /* 7. Shrink the font size of large numbers so they don't overflow cards */
    .stat-card .value {
        font-size: 1.5rem;
    }

    /* 8. Fix padding inside the page content */
    .page-content {
        padding: 1.5rem 1rem;
    }
}
       
        .topbar {
            height: 64px; border-bottom: 1px solid var(--line);
            padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            position: sticky; top: 0; z-index: 40;
        }
        .topbar-left { display: flex; align-items: center; gap: 0.75rem; }
        .topbar-breadcrumb {
            font-size: 0.75rem; color: #8e8e93;
            display: flex; align-items: center; gap: 0.4rem;
        }
        .topbar-breadcrumb span { color: #8e8e93; }
        .topbar-breadcrumb strong { color: var(--ink); font-weight: 600; }
        .topbar h2 { font-size: 0.95rem; font-weight: 600; color: var(--ink); letter-spacing: -0.2px; }
        .topbar-user { display: flex; align-items: center; gap: 0.6rem; }
        .topbar-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: var(--teal);
            color: var(--white);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.65rem; font-weight: 600;
        }
        .topbar-name { font-size: 0.8rem; font-weight: 500; color: var(--ink-2); }

        .page-content { padding: 2.25rem 2.5rem; flex: 1; max-width: 1280px; width: 100%; margin: 0 auto; }

        /* ── CARDS ── */
        .card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 12px; 
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02), 0 10px 30px rgba(0,0,0,0.01);
        }
        .card-body { padding: 1.5rem; }
        .card-header {
            padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--line);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header a {
            margin-left: 665px; /* FIX: Fixed broken layout block margins */
            height: 35px; line-height: 32px; padding: 0 0.75rem;

        }
        .card-header input {
            margin-right: 1rem;
            padding: 0.5rem 0.75rem; border-radius: 6px; border: 1px solid var(--line);
            font-size: 0.82rem; outline: none; width: 100%;

        }
        .card-header h3 { font-size: 0.88rem; font-weight: 600; color: var(--ink); }

        /* ── TABLES ── */
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.85rem 1.1rem; text-align: left; border-bottom: 1px solid var(--line); font-size: 0.83rem; }
        th {
            font-size: 0.65rem; color: #8e8e93; text-transform: uppercase;
            letter-spacing: 0.08em; font-weight: 700; background: rgba(244,244,247,0.5);
            border-bottom: 1px solid var(--line);
        }
        tr:last-child td { border-bottom: none; }
        tbody tr { transition: background 0.15s; }
        tbody tr:hover { background: rgba(0,75,78,0.02); }

        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 1rem; margin-bottom: 2rem;
        }
        .stat-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 12px; padding: 1.4rem;
            position: relative; overflow: hidden;
            transition: transform 0.2s var(--spring), box-shadow 0.2s;
            cursor: default;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.04);
        }
        .stat-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        }
        .stat-card.teal::before  { background: var(--teal); }
        .stat-card.red::before   { background: var(--red); }
        .stat-card.danger::before { background: var(--danger); }
        .stat-card.warn::before  { background: var(--warn); }
        .stat-card .label {
            font-size: 0.65rem; color: #8e8e93; text-transform: uppercase;
            letter-spacing: 0.1em; font-weight: 700; margin-bottom: 0.5rem;
        }
        .stat-card .value {
            font-size: 1.85rem; font-weight: 600; line-height: 1.1; letter-spacing: -0.5px;
            font-family: 'Space Grotesque', sans-serif;
        }
        .stat-card .sub { font-size: 0.7rem; color: #8e8e93; margin-top: 0.35rem; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.5rem 1rem; border-radius: 6px; border: 1px solid transparent;
            font-size: 0.8rem; font-weight: 600; cursor: pointer;
            text-decoration: none; transition: all 0.2s;
            font-family: inherit; letter-spacing: -0.1px;
        }
        .btn-primary {
            background: var(--red); color: var(--white); border-color: var(--red);
        }
        .btn-primary:hover { background: var(--red-dark); transform: translateY(-1px); }
        .btn-teal { background: var(--teal); color: var(--white); border-color: var(--teal); }
        .btn-teal:hover { background: var(--teal-mid); transform: translateY(-1px); }
        .btn-outline {
            background: var(--white);
            border-color: rgba(0,0,0,0.12); color: var(--ink-2);
        }
        .btn-outline:hover {
            border-color: rgba(0,75,78,0.25); color: var(--teal);
            background: rgba(0,75,78,0.03);
        }
        .btn-danger { background: var(--danger); color: var(--white); border-color: var(--danger); }
        .btn-danger:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-sm { padding: 0.3rem 0.75rem; font-size: 0.72rem; border-radius: 5px; }

        /* ── CHIPS ── */
        .chip {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 0.18rem 0.6rem; border-radius: 20px;
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.02em;
        }
        .chip-green  { background: rgba(0,135,90,0.08); color: var(--success); }
        .chip-red    { background: rgba(206,53,48,0.08); color: var(--red); }
        .chip-teal   { background: rgba(0,75,78,0.08); color: var(--teal); }
        .chip-amber  { background: rgba(180,83,9,0.08); color: var(--warn); }

        /* ── FORMS ── */
        .form-group { margin-bottom: 1.25rem; }
        .form-group label {
            display: block; font-size: 0.78rem; color: var(--ink-2);
            font-weight: 600; margin-bottom: 0.4rem;
        }
        .form-control {
            width: 100%; padding: 0.65rem 0.85rem;
            background: var(--white);
            border: 1px solid rgba(0,0,0,0.15);
            border-radius: 6px; color: var(--ink); font-size: 0.85rem;
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }
        .form-control:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(0,75,78,0.06);
        }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-error { color: var(--danger); font-size: 0.75rem; margin-top: 0.3rem; }

        /* ── FLASH ── */
        .flash {
            padding: 0.85rem 1.25rem; border-radius: 8px; margin-bottom: 1.5rem;
            font-size: 0.85rem; border-left: 3px solid;
            font-weight: 500;
        }
        .flash.success { background: rgba(0,135,90,0.05); border-color: var(--success); color: var(--success); }
        .flash.error   { background: rgba(206,53,48,0.05); border-color: var(--red); color: var(--red-dark); }

        /* ── GRID ── */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    </style>
    @stack('styles')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <a href="{{ route('admin.dashboard') }}">Mood&nbsp;Set-up&nbsp;<em>Studio</em></a>
        <p>Admin Panel</p>
    </div>
    <nav class="sidebar-nav">
        <p class="nav-label">Overview</p>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <a href="{{ route('admin.interactions') }}" class="{{ request()->routeIs('admin.interactions*') ? 'active' : '' }}">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 20V10M12 20V4M6 20v-6"/></svg>
            Analytics
        </a>

        <p class="nav-label">Catalog</p>
        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"/></svg>
            Categories
        </a>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
            Products
        </a>

        <p class="nav-label">Store</p>
        <a href="{{ route('home') }}" target="_blank">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            View Store
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Sign out</button>
        </form>
    </div>
</aside>

<div class="main-wrap">
    <div class="topbar">
        <div class="topbar-left">
            <div class="topbar-breadcrumb">
                <span>Admin</span>
                <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                <strong>@yield('topbar-title', 'Dashboard')</strong>
            </div>
        </div>
        <div class="topbar-user">
            <div class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</div>
            <span class="topbar-name">{{ auth()->user()->name ?? 'Admin' }}</span>
        </div>
    </div>
    <div class="page-content">
        @if(session('success'))
            <div class="flash success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>