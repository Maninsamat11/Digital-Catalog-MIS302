@extends('layouts.admin')

@section('title', 'Product Interactions — Admin')
@section('topbar-title', 'Detailed Analytics')

@section('content')
<div class="page-header">
    <h1>Product Interactions Report</h1>
    <p>Complete breakdown of how customers are interacting with your catalog.</p>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th style="text-align:center;">Total Views</th>
                <th style="text-align:center;">Total Searches</th>
                <th style="text-align:center;">Total Compares</th>
                <th style="text-align:center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allProducts as $item)
            <tr>
                <td style="font-weight:600;">{{ $item->product->product_name ?? 'Deleted Product' }}</td>
                <td style="text-align:center;"><span class="chip chip-green">{{ $item->views_count }}</span></td>
                <td style="text-align:center;">
                    <span class="chip" style="background:rgba(108,99,255,0.1); color:var(--accent);">{{ $item->search_count }}</span>
                </td>
                <td style="text-align:center;">
                    <span class="chip" style="background:rgba(245,166,35,0.1); color:#f5a623;">{{ $item->compare_count }}</span>
                </td>
                <td style="text-align:center;">
                    @if($item->product)
                        <a href="{{ route('admin.products.edit', $item->product_id) }}" class="btn btn-outline btn-sm">Manage</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="padding: 1.5rem;">
        {{ $allProducts->links('pagination::simple-bootstrap-5') }}
    </div>
</div>

<div style="margin-top: 1.5rem;">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">← Back to Dashboard</a>
</div>
@endsection