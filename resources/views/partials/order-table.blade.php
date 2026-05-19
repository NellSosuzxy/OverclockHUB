@if($filteredOrders->isEmpty())
    <p style="color: var(--text-muted); font-family: monospace;">No orders match this filter.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Trace ID</th>
                <th>Date</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($filteredOrders as $order)
                <tr>
                    <td style="font-family: monospace; color: var(--accent);">{{ $order->trace_id }}</td>
                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        @foreach($order->items as $item)
                            <div style="margin-bottom: 0.3rem;">
                                <span>{{ $item->product_name }}</span>
                                <span style="color: var(--text-muted);"> x{{ $item->quantity }}</span>
                            </div>
                        @endforeach
                    </td>
                    <td style="font-family: monospace; font-weight: 700;">RM {{ number_format($order->total, 2) }}</td>
                    <td>
                        @if($order->status === 'delivered')
                            <span class="status status-ok">{{ strtoupper($order->status) }}</span>
                        @else
                            <span class="status status-warn">{{ strtoupper($order->status) }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
