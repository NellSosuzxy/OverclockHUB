@extends('layouts.app')

@section('content')
    <h2 class="section-title">// <span>Telemetry</span> — Order History</h2>

    @if($orders->isEmpty())
        <p style="color: var(--text-muted); font-family: monospace; padding: 2rem 0;">No orders found in system logs.</p>
    @else
        <div class="order-tabs">
            <span class="order-tab active" data-tab="all" onclick="switchOrderTab('all')">All Orders</span>
            <span class="order-tab" data-tab="queued" onclick="switchOrderTab('queued')">Queued</span>
            <span class="order-tab" data-tab="shipped" onclick="switchOrderTab('shipped')">Shipped</span>
            <span class="order-tab" data-tab="delivered" onclick="switchOrderTab('delivered')">Delivered</span>
        </div>

        <div id="tab-all" class="order-content active">
            @include('partials.order-table', ['filteredOrders' => $orders->getCollection()])
        </div>
        <div id="tab-queued" class="order-content">
            @include('partials.order-table', ['filteredOrders' => $orders->getCollection()->where('status', 'queued')])
        </div>
        <div id="tab-shipped" class="order-content">
            @include('partials.order-table', ['filteredOrders' => $orders->getCollection()->where('status', 'shipped')])
        </div>
        <div id="tab-delivered" class="order-content">
            @include('partials.order-table', ['filteredOrders' => $orders->getCollection()->where('status', 'delivered')])
        </div>

        <div style="margin-top: 2rem;">
            {{ $orders->links('partials.pagination') }}
        </div>
    @endif
@endsection
