@extends('layouts.app')

@section('content')
    <div style="max-width: 700px; margin: 4rem auto; text-align: center;">
        <h1 style="color: var(--success); font-size: 3rem; margin-bottom: 1rem;">ORDER CONFIRMED</h1>
        
        <div style="background-color: rgba(0, 255, 102, 0.05); border: 1px solid var(--success); padding: 1.5rem; margin-bottom: 2rem; text-align: left; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -10px; right: -10px; opacity: 0.1;"><i data-lucide="check-circle" style="width: 100px; height: 100px; color: var(--success);"></i></div>
            <h3 style="color: var(--success); display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                <i data-lucide="shield-check" style="width: 1.2rem; height: 1.2rem;"></i> PAYMENT AUTHORIZED
            </h3>
            <p style="color: var(--text-main); font-family: monospace; font-size: 0.95rem; margin-bottom: 0; line-height: 1.6;">
                Your transaction of <strong style="color: var(--accent);">RM {{ number_format($order->total, 2) }}</strong> was successful. The components have been officially logged and are currently queuing for logistics deployment.
            </p>
        </div>

        <div style="background-color: var(--bg-card); border: 1px solid var(--border); padding: 2.5rem; text-align: left;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="color: var(--text-muted);">Trace ID</span>
                <span style="font-family: monospace; color: var(--accent);">{{ $order->trace_id }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="color: var(--text-muted);">Status</span>
                <span class="status status-warn">{{ strtoupper($order->status) }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="color: var(--text-muted);">Subtotal</span>
                <span style="font-family: monospace;">RM {{ number_format($order->subtotal, 2) }}</span>
            </div>
            @if($order->discount > 0)
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: var(--success);">
                    <span>Discount</span>
                    <span style="font-family: monospace;">-RM {{ number_format($order->discount, 2) }}</span>
                </div>
            @endif
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="color: var(--text-muted);">Shipping</span>
                <span style="font-family: monospace;">{{ $order->shipping_fee == 0 ? 'FREE' : 'RM ' . number_format($order->shipping_fee, 2) }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-top: 1rem; border-top: 1px dashed var(--border);">
                <span style="font-weight: 900; font-size: 1.2rem;">TOTAL</span>
                <span style="font-family: monospace; font-size: 1.4rem; color: var(--accent);">RM {{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: center;">
            <a href="{{ route('orders.index') }}" class="btn btn-outline">View All Orders</a>
            <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>
@endsection
