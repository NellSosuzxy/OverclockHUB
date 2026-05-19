{{-- Catalog View: Displays the grid of available hardware categorized by equipment type --}}
@extends('layouts.app')

@section('content')
    {{-- Page Header --}}
    <h2 class="section-title">// <span>{{ $category->name }}</span> Inventory</h2>

    @if($products->isEmpty())
        <div class="alert alert-info text-center" style="border: 1px solid var(--border); padding: 3rem;">
            <p style="color: var(--text-muted); font-family: monospace; font-size: 1.2rem; margin: 0;"><i data-lucide="triangle-alert" style="width: 1.2rem; height: 1.2rem; vertical-align: middle; margin-right: 0.5rem;"></i> No hardware found in this registry or currently out of stock.</p>
        </div>
    @else
        <div class="grid-4">
            @foreach($products as $product)
                <div class="card hover-elevate stagger-item">
                    <div>
                        <div class="img-container">
                            <img src="{{ asset('images/' . $product->name . '.png') }}" alt="{{ $product->name }}">
                        </div>
                        <h3 title="{{ $product->name }}">{{ $product->name }}</h3>
                        <p style="color: {{ $product->stock > 0 ? 'var(--success)' : 'var(--danger)' }}; font-size: 0.8rem; font-family: monospace; margin-bottom: 0.5rem;">
                            {{ $product->sku }} &bull; {{ $product->stock > 0 ? 'STATUS: IN STOCK (' . $product->stock . ')' : 'STATUS: DEPLETED' }}
                        </p>
                        <div class="price">RM {{ number_format($product->price, 2) }}</div>
                    </div>
                    <div style="margin-top: 1.5rem;">
                        @auth
                            @if($product->stock > 0)
                                <form method="POST" action="{{ route('cart.add') }}" onsubmit="this.querySelector('button').disabled = true; this.querySelector('button').innerHTML = 'Processing...';">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary w-100">Add to Queue</button>
                                </form>
                            @else
                                <button class="btn btn-outline w-100" disabled style="opacity: 0.4; cursor: not-allowed; border-color: var(--danger); color: var(--danger);">Depleted</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline w-100" style="text-align: center;">Login to Purchase</a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 3rem; display: flex; justify-content: center;">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    @endif
@endsection
