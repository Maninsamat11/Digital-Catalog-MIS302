@extends('layouts.app')

@section('title', $category->category_name . ' — Mood Set-Up Studio')

@section('content')

<div style="margin-bottom:2rem;">
    <a href="{{ route('home') }}" style="color:var(--muted);text-decoration:none;font-size:0.85rem;">Home</a>
    <span style="color:var(--muted);margin:0 0.5rem;">/</span>
    <span style="font-size:0.85rem;color:var(--text);">{{ $category->category_name }}</span>
</div>

<div class="page-header">
    <h1>{{ $category->category_name }}</h1>
    <p>{{ $products->count() }} products available</p>
</div>

@if($products->isEmpty())
    <div style="text-align:center;padding:4rem 0;">
        <p style="color:var(--muted);">No products in this category yet.</p>
    </div>
@else
    <div class="product-grid">
        @foreach($products as $product)
            @include('partials.product-card', ['product' => $product])
        @endforeach
    </div>
@endif

@endsection
