@extends('layouts.app')

@section('content')
    <h2 class="section-title">// Hardware <span>Queue</span></h2>

    @if($cartItems->isEmpty())
        <div style="text-align: center; padding: 4rem 0; border: 1px dashed var(--border); background-color: var(--bg-card); margin-top: 2rem;">
            <div style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"><i data-lucide="shopping-cart" style="width: 4rem; height: 4rem;"></i></div>
            <p style="color: var(--text-muted); font-family: monospace; font-size: 1.2rem; margin-bottom: 2rem;">Queue is empty. Browse hardware to add items.</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="padding: 1rem 2rem;">Return to Terminal</a>
        </div>
    @else
        <div class="cart-grid">
            <div class="table-responsive" style="overflow-x: auto;">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Component</th>
                            <th>Unit Price</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Subtotal</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr class="hover-bg-alt" style="transition: background-color 0.2s;">
                                <td>
                                    <strong style="color: var(--accent);">{{ $item->product->name }}</strong>
                                    <br><span style="color: var(--text-muted); font-size: 0.8rem; font-family: monospace;">SKU: {{ $item->product->sku }}</span>
                                    @if($item->quantity >= $item->product->stock)
                                        <br><span style="color: var(--warning); font-size: 0.75rem; font-weight: bold;">Max Stock Reached</span>
                                    @endif
                                </td>
                                <td style="font-family: monospace; opacity: 0.8;">RM {{ number_format($item->product->price, 2) }}</td>
                                <td style="text-align: center;">
                                    <form method="POST" action="{{ route('cart.update', $item) }}" style="display: inline-flex; gap: 0.5rem; justify-content: center;">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control" style="width: 70px; margin-bottom: 0; padding: 0.5rem; text-align: center; border-color: var(--border);">
                                        <button type="submit" class="btn btn-outline" style="padding: 0.5rem 0.75rem; font-size: 0.75rem;">Set</button>
                                    </form>
                                </td>
                                <td style="font-family: monospace; color: var(--text-main); font-weight: bold; text-align: right;">RM {{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                <td style="text-align: center;">
                                    <form method="POST" action="{{ route('cart.destroy', $item) }}" onsubmit="return confirm('Remove hardware from queue?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 0.5rem 0.75rem; font-size: 0.75rem;">X</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="checkout-panel" style="position: sticky; top: 100px;">
                <h3 style="margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem; color: var(--accent);">Order Summary</h3>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: var(--text-muted);">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                    <span style="font-family: monospace;">RM {{ number_format($subtotal, 2) }}</span>
                </div>

                @if($appliedVoucher)
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: var(--success); padding: 0.5rem; background: rgba(0, 255, 102, 0.1); border-left: 2px solid var(--success);">
                        <span>Code Applied: {{ strtoupper($appliedVoucher->code) }}</span>
                        <span style="font-family: monospace;">-RM {{ number_format($discount, 2) }}</span>
                    </div>
                @endif

                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: var(--text-muted);">Logistics Fee</span>
                    <span style="font-family: monospace; color: {{ $shippingFee == 0 ? 'var(--success)' : 'inherit' }};">
                        {{ $shippingFee == 0 ? 'STATUS: WAIVED' : 'RM ' . number_format($shippingFee, 2) }}
                    </span>
                </div>

                @if($shippingFee > 0)
                    <div style="height: 4px; background: var(--bg-main); margin-bottom: 0.5rem; border-radius: 2px; overflow: hidden;">
                        <div style="height: 100%; width: {{ min(($subtotal / 5000) * 100, 100) }}%; background: var(--accent);"></div>
                    </div>
                    <p style="color: var(--accent); font-size: 0.75rem; margin-bottom: 1.5rem; text-align: right;">
                        Add RM {{ number_format(5000 - $subtotal, 2) }} for Free Logistics
                    </p>
                @else
                    <p style="color: var(--success); font-size: 0.75rem; margin-bottom: 1.5rem; text-align: right; font-weight: bold;">
                        Valid for Free Express Logistics
                    </p>
                @endif

                <div style="margin-bottom: 1.5rem; padding: 1rem; background: var(--bg-main); border: 1px solid var(--border);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Delivery Coordinates</span>
                        <a href="{{ route('profile.edit') }}" style="color: var(--accent); font-size: 0.75rem; text-decoration: none;">[ EDIT ]</a>
                    </div>
                    @if(trim((string) Auth::user()->address) !== '')
                        <p style="font-family: monospace; font-size: 0.85rem; color: var(--text-main); margin: 0; white-space: pre-line;">{{ Auth::user()->address }}</p>
                    @else
                        <p style="font-family: monospace; font-size: 0.85rem; color: var(--danger); margin: 0; font-weight: bold;">NO ADDRESS CONFIGURED</p>
                    @endif
                </div>

                <div style="display: flex; justify-content: space-between; padding-top: 1.5rem; border-top: 1px dashed var(--border); margin-bottom: 2rem;">
                    <span style="font-weight: 900; font-size: 1.2rem;">TOTAL AUTHORIZATION</span>
                    <span style="font-family: monospace; font-size: 1.6rem; color: var(--accent);">RM {{ number_format($total, 2) }}</span>
                </div>

                <form method="POST" action="{{ route('cart.voucher') }}" style="margin-bottom: 2rem; background: var(--bg-main); padding: 1rem; border: 1px solid var(--border);">
                    @csrf
                    <label style="display:block; color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Access Code (Voucher)</label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" name="voucher_code" class="form-control" placeholder="ENTER CODE..." style="margin-bottom: 0; text-transform: uppercase;" value="{{ $appliedVoucher->code ?? '' }}" required>
                        <button type="submit" class="btn btn-outline" style="white-space: nowrap;">Apply</button>
                    </div>
                    @if($appliedVoucher)
                        <small style="display: block; margin-top: 0.5rem; color: var(--success);">Valid code applied.</small>
                    @endif
                </form>

                <a href="{{ route('checkout.page') }}" class="btn btn-primary w-100" style="padding: 1rem; font-size: 1rem; text-align: center;">PROCEED TO SECURE PAYMENT <i data-lucide="shield-check" style="width: 1.2rem; height: 1.2rem; margin-left: 0.5rem; vertical-align: middle;"></i></a>
            </div>
        </div>
    @endif
</div>
@endsection
