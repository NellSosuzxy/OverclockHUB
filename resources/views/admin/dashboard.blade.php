{{-- Admin Dashboard: Command center for Root operators containing unified logistics and hardware management --}}
@extends('layouts.app')

@section('content')
    {{-- Header Section --}}
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem;">
        <h2 class="section-title" style="color: var(--danger); border-bottom: none; margin: 4rem 0 0 0;">// <span style="color: var(--danger);">Root</span> Command Center</h2>
        <span style="font-family: monospace; color: var(--text-muted); font-size: 0.9rem;">ACCESS LEVEL: MAXIMUM</span>
    </div>
    
    <div class="grid-4" style="margin-bottom: 3rem;">
        <div class="feature-box stagger-item" style="border-top: 3px solid var(--border);">
            <h1 style="color: var(--text-main);">{{ $orderStats['total'] }}</h1>
            <h3 style="color: var(--text-muted);">Total Orders</h3>
        </div>
        <div class="feature-box stagger-item" style="border-top: 3px solid var(--warning);">
            <h1 style="color: var(--warning);">{{ $orderStats['queued'] }}</h1>
            <h3>Queued</h3>
        </div>
        <div class="feature-box stagger-item" style="border-top: 3px solid var(--accent);">
            <h1 style="color: var(--accent);">{{ $orderStats['shipped'] }}</h1>
            <h3>Shipped</h3>
        </div>
        <div class="feature-box stagger-item" style="border-top: 3px solid var(--success);">
            <h1 style="color: var(--success);">{{ $orderStats['delivered'] }}</h1>
            <h3>Delivered</h3>
        </div>
    </div>

    {{-- ADMIN QUICK LINKS --}}
    <div style="display: flex; gap: 1rem; margin-bottom: 3rem; background: var(--bg-card); padding: 1.5rem; border: 1px solid var(--border);">
        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-outline" style="flex: 1;">Voucher Management</a>
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline" style="flex: 1;">Support Tickets</a>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success" style="flex: 1;">+ Add Hardware</a>
    </div>

    {{-- ORDER MANAGEMENT --}}
    <div class="card" style="margin-bottom: 4rem; overflow: hidden; padding: 0;">
        <div style="padding: 1.5rem; border-bottom: 1px solid var(--border); background: var(--bg-alt);">
            <h3 style="margin: 0; color: var(--accent);">// Logistics Management</h3>
        </div>
        
        <div style="padding: 1.5rem;">
            @if($orders->isEmpty())
                <div class="alert alert-info text-center" style="margin-top: 1rem;">No orders currently in the system.</div>
            @else
                <div style="overflow-x: auto;">
                    <table style="margin-bottom: 1rem; border: none;">
                        <thead>
                            <tr>
                                <th>Trace ID</th>
                                <th>Operator</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="hover-bg-alt">
                                    <td style="font-family: monospace; color: var(--accent); font-weight: bold;">{{ $order->trace_id }}</td>
                                    <td>{{ $order->user?->name ?? 'SYSTEM_ORPHAN' }}</td>
                                    <td style="font-family: monospace; color: var(--text-muted);">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    <td style="font-family: monospace; font-weight: 700;">RM {{ number_format($order->total, 2) }}</td>
                                    <td>
                                        @if($order->status === 'delivered')
                                            <span class="status status-ok" style="background: rgba(0,255,102,0.1); border: none;">{{ strtoupper($order->status) }}</span>
                                        @elseif($order->status === 'shipped')
                                            <span class="status" style="color: var(--accent); background: rgba(0,229,255,0.1); border: none;">{{ strtoupper($order->status) }}</span>
                                        @else
                                            <span class="status status-warn" style="background: rgba(255,204,0,0.1); border: none;">{{ strtoupper($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.orders.update', $order) }}" style="display: flex; gap: 0.5rem; align-items: center;" onsubmit="this.querySelector('button').disabled = true;">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-control" style="width: auto; margin-bottom: 0; padding: 0.4rem 0.6rem; font-size: 0.8rem;">
                                                <option value="queued" {{ $order->status === 'queued' ? 'selected' : '' }}>Queued</option>
                                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            </select>
                                            <button type="submit" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 1rem; display: flex; justify-content: flex-end;">
                    {{ $orders->links('partials.pagination') }}
                </div>
            @endif
        </div>
    </div>

    {{-- PRODUCT MANAGEMENT --}}
    <div class="card" style="margin-bottom: 2rem; overflow: hidden; padding: 0;">
        <div style="padding: 1.5rem; border-bottom: 1px solid var(--border); background: var(--bg-alt); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; color: var(--text-main);">// Hardware Registry Database</h3>
            <span style="font-family: monospace; font-size: 0.8rem; color: var(--text-muted);">{{ $products->total() }} ASSETS LOGGED</span>
        </div>
        
        <div style="padding: 1.5rem;">
            <div style="overflow-x: auto;">
                <table style="border: none;">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Nomenclature</th>
                            <th>Class</th>
                            <th>Value</th>
                            <th>Inventory Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="hover-bg-alt">
                                <td style="font-family: monospace; color: var(--text-muted);">{{ $product->sku }}</td>
                                <td style="font-weight: 500;">{{ $product->name }}</td>
                                <td style="color: var(--accent); font-family: monospace; font-size: 0.85rem;">{{ strtoupper($product->category?->name ?? 'UNCLASSIFIED') }}</td>
                                <td style="font-family: monospace;">RM {{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->stock > 10)
                                        <span class="status status-ok" style="border:none; background: rgba(0,255,102,0.1);">{{ $product->stock }} UNITS</span>
                                    @elseif($product->stock > 0)
                                        <span class="status status-warn" style="border:none; background: rgba(255,204,0,0.1);">LOW: {{ $product->stock }}</span>
                                    @else
                                        <span class="status" style="color: var(--danger); background: rgba(255,51,51,0.1); border:none;">DEPLETED (0)</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Edit</a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this hardware?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.8rem; border-color: var(--danger); color: var(--danger);">Del</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 1.5rem; display: flex; justify-content: center;">
                {{ $products->links('partials.pagination') }}
            </div>
        </div>
    </div>
@endsection
