@extends('layouts.app')

@section('content')
    <h2 class="section-title" style="color: var(--danger);">// <span>Voucher</span> Management</h2>

    <div style="margin-bottom: 2rem;">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">&laquo; Back to Dashboard</a>
    </div>

    @if($vouchers->isEmpty())
        <p style="color: var(--text-muted); font-family: monospace;">No vouchers found in the system.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Min Order</th>
                    <th>Usage</th>
                    <th>Expires</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vouchers as $voucher)
                    <tr>
                        <td style="font-family: monospace; color: var(--accent);">{{ $voucher->code }}</td>
                        <td style="font-family: monospace;">RM {{ number_format($voucher->discount_amount, 2) }}</td>
                        <td style="font-family: monospace;">RM {{ number_format($voucher->min_order_amount, 2) }}</td>
                        <td style="font-family: monospace;">{{ $voucher->times_used }} / {{ $voucher->max_uses ?? '∞' }}</td>
                        <td>
                            @if($voucher->expires_at)
                                {{ $voucher->expires_at->format('d M Y') }}
                                @if($voucher->expires_at->isPast())
                                    <span style="color: var(--danger); font-size: 0.75rem;">(EXPIRED)</span>
                                @endif
                            @else
                                <span style="color: var(--text-muted);">No expiry</span>
                            @endif
                        </td>
                        <td>
                            @if($voucher->isValid())
                                <span class="status status-ok">ACTIVE</span>
                            @else
                                <span class="status" style="color: var(--danger); border-color: var(--danger);">INACTIVE</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 1rem;">
            {{ $vouchers->links('partials.pagination') }}
        </div>
    @endif
@endsection
