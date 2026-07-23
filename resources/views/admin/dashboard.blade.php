@extends('layouts.admin')

@section('title', 'Dashboard — Admin')
@section('topbar-title', 'Dashboard')

@push('styles')
<style>
/* ── LOCAL EXECUTIVE COLOR OVERRIDES ── */
:root {
    --indigo: #004b4e;       /* Consistent deep teal */
    --steel-blue: #0284c7;   /* Sleek Slate Blue for insights */
    --amber: #b45309;        /* Warm Amber for restocking warnings */
    --amber-pale: #fef3c7;
}

/* ── PROGRESS BARS ── */
.progress-wrap { margin-bottom: 1.25rem; }
.progress-wrap:last-child { margin-bottom: 0; }
.progress-meta {
    display: flex; justify-content: space-between; align-items: baseline;
    font-size: 0.8rem; margin-bottom: 0.4rem;
}
.progress-meta span { text-transform: capitalize; font-weight: 600; color: var(--ink-2); }
.progress-meta small { color: var(--muted); font-size: 0.72rem; font-weight: 500; }
.progress-track {
    background: var(--ghost); border-radius: 4px; height: 5px; overflow: hidden; /* Thinner elegant track */
}
.progress-fill {
    height: 100%; border-radius: 4px;
    transition: width 0.7s cubic-bezier(.25,.8,.25,1);
}

/* ── BAR CHART ── */
.bar-chart {
    display: flex; align-items: flex-end; gap: 0.75rem;
    height: 150px; padding: 0.5rem 0.25rem 0;
}
.bar-col {
    flex: 1; display: flex; flex-direction: column; align-items: center; gap: 0.45rem;
}
.bar-val { font-size: 0.68rem; color: var(--muted); font-weight: 600; }
.bar-fill {
    width: 100%; border-radius: 4px 4px 0 0;
    background: var(--teal);
    transition: height 0.6s cubic-bezier(.25,.8,.25,1);
    min-height: 4px;
}
/* Elegant deep gray for 'Today' */
.bar-fill.accent { background: #111115; }
.bar-date { font-size: 0.65rem; color: var(--muted); white-space: nowrap; font-weight: 600; }

/* ── TABLE CHIP ── */
.rank-num {
    width: 24px; height: 24px; border-radius: 6px;
    background: var(--ghost); display: inline-flex;
    align-items: center; justify-content: center;
    font-size: 0.72rem; font-weight: 700; color: var(--ink-2);
}

/* ── OPERATIONS HUB ── */
.ops-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}
.alert-strip {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    background: #fff;
    border: 1px solid var(--line);
    margin-bottom: 0.6rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.alert-strip:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
}
.alert-strip:last-child { margin-bottom: 0; }
.alert-strip-info {
    display: flex;
    align-items: center;
    min-width: 0; /* allow text to truncate instead of pushing the button off-screen */
}
.alert-strip-info > div { min-width: 0; }
.alert-strip-info p { overflow: hidden; text-overflow: ellipsis; }
.alert-indicator {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 12px;
    flex-shrink: 0;
}
.indicator-steel { background: var(--steel-blue); box-shadow: 0 0 8px rgba(2, 132, 199, 0.4); }
.indicator-amber { background: var(--warn); box-shadow: 0 0 8px rgba(180, 83, 9, 0.4); }

/* Overrides for local elements */
.chip-amber-local {
    background: var(--amber-pale);
    color: var(--warn);
    font-weight: 700;
}
.chip-steel-local {
    background: #e0f2fe;
    color: var(--steel-blue);
    font-weight: 700;
}

/* ── RESPONSIVE (mobile / tablet) ── */
@media (max-width: 768px) {
    .ops-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

@media (max-width: 480px) {
    .alert-strip {
        flex-direction: column;
        align-items: stretch;
    }
    .alert-strip-info {
        margin-bottom: 0.6rem;
    }
    .alert-strip > .btn {
        align-self: stretch;
        text-align: center;
    }
    .bar-chart {
        gap: 0.4rem;
        padding-right: 0.5rem;
    }
    .bar-date {
        font-size: 0.58rem;
    }
    .bar-val {
        font-size: 0.6rem;
    }
}
</style>
@endpush

@section('content')

{{-- STAT CARDS --}}
<div class="stats-grid">
    <div class="stat-card teal">
        <p class="label">Total Products</p>
        <p class="value" style="color:var(--teal);">{{ $totalProducts }}</p>
        <p class="sub">Across all categories</p>
    </div>
    <div class="stat-card" style="border-top: 3px solid var(--indigo);">
        <p class="label">Categories</p>
        <p class="value" style="color:var(--indigo);">{{ $totalCategories }}</p>
        <p class="sub">Active categories</p>
    </div>
    <div class="stat-card" style="border-top: 3px solid var(--amber);">
        <p class="label">Out of Stock</p>
        <p class="value" style="color:var(--warn);">{{ $outOfStock }}</p>
        <p class="sub">Need restocking</p>
    </div>
    <div class="stat-card" style="border-top: 3px solid var(--steel-blue);">
        <p class="label">Total Interactions</p>
        <p class="value" style="color:var(--steel-blue);">{{ $totalInteractions }}</p>
        <p class="sub">Views, searches, compares</p>
    </div>
</div>

{{-- SMART OPERATIONS HUB --}}
<div class="ops-grid">

    {{-- RESTOCK ALERTS --}}
    <div class="card">
        <div class="card-header">
            <h3>Restock Alerts <span class="chip chip-amber-local" style="font-size:0.6rem; font-weight: 700; margin-left:8px;">{{ $lowStockProducts->count() }} Products</span></h3>
        </div>
        <div class="card-body" style="max-height: 290px; overflow-y: auto;">
            @forelse($lowStockProducts as $lowProduct)
                <div class="alert-strip" style="border-left: 3px solid var(--amber);">
                    <div class="alert-strip-info">
                        <span class="alert-indicator indicator-amber"></span>
                        <div>
                            <p style="font-weight: 600; font-size: 0.82rem; margin: 0; color: var(--ink);">{{ $lowProduct->product_name }}</p>
                            <p style="font-size: 0.72rem; color: var(--muted); margin: 0; margin-top: 2px;">
                                Stock: <strong style="color: var(--amber);">{{ $lowProduct->stock_quantity }} units</strong> (Limit: {{ $lowProduct->stock_threshold }})
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('admin.products.edit', $lowProduct) }}" class="btn btn-outline btn-sm">Restock</a>
                </div>
            @empty
                <p style="color:var(--muted); text-align:center; padding: 2.5rem 0; font-size:0.8rem; font-weight:500;">All nodes operating at optimal capacity.</p>
            @endforelse
        </div>
    </div>

    {{-- QUICK ACTIONS & SYSTEM UTILITIES --}}
    <div class="card">
        <div class="card-header">
            <h3>Quick Actions & Utilities</h3>
        </div>
        <div class="card-body" style="max-height: 290px; overflow-y: auto; display: flex; flex-direction: column; gap: 0.6rem;">

            <div class="alert-strip" style="border-left: 3px solid var(--teal); margin-bottom: 0;">
                <div class="alert-strip-info">
                    <span class="alert-indicator" style="background: var(--teal); box-shadow: 0 0 8px rgba(0, 75, 78, 0.4);"></span>
                    <div>
                        <p style="font-weight: 600; font-size: 0.82rem; margin: 0; color: var(--ink);">Add New Product</p>
                        <p style="font-size: 0.72rem; color: var(--muted); margin: 0; margin-top: 2px;">Insert a single item into the active digital catalog.</p>
                    </div>
                </div>
                <a href="{{ route('admin.products.create') }}" class="btn btn-teal btn-sm">+ Add</a>
            </div>

            <div class="alert-strip" style="border-left: 3px solid var(--steel-blue); margin-bottom: 0;">
                <div class="alert-strip-info">
                    <span class="alert-indicator indicator-steel"></span>
                    <div>
                        <p style="font-weight: 600; font-size: 0.82rem; margin: 0; color: var(--ink);">Bulk CSV Import</p>
                        <p style="font-size: 0.72rem; color: var(--muted); margin: 0; margin-top: 2px;">Upload catalog spreadsheets to update items in bulk.</p>
                    </div>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">Import</a>
            </div>

            <div class="alert-strip" style="border-left: 3px solid var(--warn); margin-bottom: 0;">
                <div class="alert-strip-info">
                    <span class="alert-indicator indicator-amber"></span>
                    <div>
                        <p style="font-weight: 600; font-size: 0.82rem; margin: 0; color: var(--ink);">Manage Categories</p>
                        <p style="font-size: 0.72rem; color: var(--muted); margin: 0; margin-top: 2px;">Organize product classifications and active categories.</p>
                    </div>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline btn-sm">Manage</a>
            </div>

        </div>
    </div>

</div>

{{-- TOP ROW --}}
<div class="grid-2" style="margin-bottom:1.5rem;">

    {{-- PRODUCT ACTIVITY TABLE --}}
    <div class="card">
        <div class="card-header">
            <h3>Product Activity Leaderboard</h3>
            <a href="{{ route('admin.interactions') }}" class="btn btn-outline btn-sm">Full Report →</a>
        </div>
        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th style="width:32px;">#</th>
                    <th>Product</th>
                    <th style="text-align:center;">Views</th>
                    <th style="text-align:center;">Search</th>
                    <th style="text-align:center;">Compare</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topProducts as $i => $item)
                <tr>
                    <td><span class="rank-num">{{ $i + 1 }}</span></td>
                    <td style="font-weight:500;font-size:0.82rem;max-width:160px;">
                        <div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis; color: var(--ink);">
                            {{ $item->product->product_name ?? 'Deleted Product' }}
                        </div>
                    </td>
                    <td style="text-align:center;">
                        <span class="chip chip-teal" style="font-size: 0.65rem;">{{ $item->views_count }}</span>
                    </td>
                    <td style="text-align:center;">
                        <span class="chip chip-steel-local" style="font-size: 0.65rem;">{{ $item->search_count }}</span>
                    </td>
                    <td style="text-align:center;">
                        <span class="chip chip-amber-local" style="font-size: 0.65rem;">{{ $item->compare_count }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="color:var(--muted);text-align:center;padding:2.5rem;font-size:0.82rem;">
                        No interaction data yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    {{-- INTERACTIONS BY TYPE --}}
    <div class="card">
        <div class="card-header">
            <h3>Interactions by Type</h3>
        </div>
        <div class="card-body">
            @php
                $typeColors = [
                    'view'    => 'var(--teal)',
                    'search'  => 'var(--steel-blue)',
                    'compare' => 'var(--warn)',
                ];
            @endphp

            @forelse($interactionsByType as $type => $count)
                @php
                    $total = $interactionsByType->sum();
                    $pct   = $total > 0 ? round($count / $total * 100) : 0;
                    $color = $typeColors[$type] ?? 'var(--teal)';
                @endphp
                <div class="progress-wrap">
                    <div class="progress-meta">
                        <span style="font-size:0.78rem; font-weight:600; text-transform: uppercase; letter-spacing:0.02em;">{{ $type }}</span>
                        <small style="font-weight:600; color: var(--muted);">{{ number_format($count) }} &nbsp;·&nbsp; {{ $pct }}%</small>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width:{{ $pct }}%;background:{{ $color }};"></div>
                    </div>
                </div>
            @empty
                <p style="color:var(--muted);text-align:center;padding:2.5rem 0;font-size:0.82rem;">
                    No interactions recorded yet.
                </p>
            @endforelse

            @if($interactionsByType->isNotEmpty())
            <div style="margin-top:1.5rem;padding-top:1.25rem;border-top:1px solid var(--line);display:flex;gap:1.5rem;flex-wrap:wrap;">
                @foreach($typeColors as $label => $color)
                <div style="display:flex;align-items:center;gap:0.4rem;">
                    <div style="width:6px;height:6px;border-radius:50%;background:{{ $color }};"></div>
                    <span style="font-size:0.7rem;color:var(--muted);text-transform:capitalize; font-weight: 600;">{{ $label }}</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

{{-- DAILY CHART --}}
<div class="card">
    <div class="card-header">
        <h3>Daily Interactions — Last 7 Days</h3>
        <span style="font-size:0.75rem;color:var(--muted); font-weight: 600;">{{ now()->subDays(6)->format('M d') }} – {{ now()->format('M d, Y') }}</span>
    </div>
    <div class="card-body">
        @if($dailyInteractions->isEmpty())
            <p style="color:var(--muted);text-align:center;padding:3rem 0;font-size:0.85rem;">
                No data for the past 7 days.
            </p>
        @else
            @php $maxCount = $dailyInteractions->max('count') ?: 1; @endphp
            <div class="bar-chart">
                @foreach($dailyInteractions as $i => $day)
                    @php
                        $height  = max(8, round(($day->count / $maxCount) * 110));
                        $isToday = \Carbon\Carbon::parse($day->date)->isToday();
                    @endphp
                    <div class="bar-col">
                        <span class="bar-val" style="color: var(--muted); font-size: 0.65rem;">{{ $day->count }}</span>
                        <div class="bar-fill {{ $isToday ? 'accent' : '' }}" style="height:{{ $height }}px;"></div>
                        <span class="bar-date" style="color: var(--muted); font-weight:600;">{{ \Carbon\Carbon::parse($day->date)->format('M d') }}</span>
                    </div>
                @endforeach
            </div>
            <div style="margin-top:1rem;display:flex;gap:1.5rem;align-items:center;flex-wrap:wrap;">
                <div style="display:flex;align-items:center;gap:0.4rem;">
                    <div style="width:10px;height:10px;border-radius:3px;background:var(--teal);"></div>
                    <span style="font-size:0.7rem;color:var(--muted); font-weight: 600;">Previous days</span>
                </div>
                <div style="display:flex;align-items:center;gap:0.4rem;">
                    <div style="width:10px;height:10px;border-radius:3px;background:#111115;"></div>
                    <span style="font-size:0.7rem;color:var(--muted); font-weight: 600;">Today</span>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection