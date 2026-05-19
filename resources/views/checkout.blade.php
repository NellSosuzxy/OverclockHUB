@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 2rem auto; animation: fadeUp 0.6s ease-out;">
    <h2 class="section-title" style="text-align: center; margin-bottom: 2rem; border: none;">// Secure <span>Payment Gateway</span></h2>
    
    <div style="background-color: var(--bg-card); border: 1px solid var(--accent); padding: 2.5rem; border-top: 4px solid var(--accent); position: relative; overflow: hidden;">
        <!-- decorative elements -->
        <div style="position: absolute; top: -20px; right: -20px; opacity: 0.05;"><i data-lucide="shield-check" style="width: 150px; height: 150px;"></i></div>
        
        <div style="text-align: center; margin-bottom: 2.5rem; position: relative;">
            <p style="color: var(--text-muted); font-family: monospace; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 2px;">Total Authorization Amount</p>
            <div style="font-size: 3rem; color: var(--text-main); font-weight: 900; font-family: monospace;">RM {{ number_format($total, 2) }}</div>
        </div>

        <form method="POST" action="{{ route('checkout') }}" onsubmit="this.querySelector('button[type=submit]').disabled = true; this.querySelector('button[type=submit]').innerHTML = 'Processing Transaction...';">
            @csrf
            
            <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Cardholder Name</label>
            <input type="text" class="form-control" placeholder="JOHN DOE" value="{{ Auth::user()->name }}" required style="font-family: inherit; font-weight: 500;">

            <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; margin-top: 1.5rem;">Card Number</label>
            <div style="position: relative;">
                <input type="text" id="cardNumber" class="form-control" placeholder="XXXX XXXX XXXX XXXX" pattern="[\d\s]{19}" title="16 digit card number" maxlength="19" required style="letter-spacing: 2px; font-size: 1.1rem; padding-left: 1rem;">
            </div>

            <div class="grid-2" style="margin-bottom: 1.5rem; margin-top: 1.5rem; gap: 1rem;">
                <div>
                    <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Expiry Date &nbsp;(MM/YY)</label>
                    <input type="text" class="form-control" placeholder="12/26" pattern="\d{2}/\d{2}" title="Format: MM/YY" maxlength="5" required style="letter-spacing: 1px;">
                </div>
                <div>
                    <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">CVC / CVV</label>
                    <input type="password" class="form-control" placeholder="•••" pattern="\d{3,4}" title="3 or 4 digit security code" maxlength="4" required style="letter-spacing: 3px;">
                </div>
            </div>

            <div style="display: flex; gap: 1rem; align-items: flex-start; margin: 2rem 0; padding: 1rem; background: rgba(0, 240, 255, 0.05); border: 1px solid var(--accent-dim);">
                <i data-lucide="lock" style="color: var(--accent); width: 1.5rem; height: 1.5rem; flex-shrink: 0; margin-top: 0.2rem;"></i>
                <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0; line-height: 1.5; font-family: monospace;">
                    256-bit encrypted connection. Your payment information is securely processed and will not be stored on terminal servers.
                </p>
            </div>

            <button type="submit" class="btn btn-primary w-100" style="padding: 1rem; font-size: 1.1rem; letter-spacing: 2px;">AUTHORIZE PAYMENT</button>
            <a href="{{ route('cart.index') }}" class="btn w-100" style="margin-top: 1rem; text-align: center; color: var(--text-muted); font-size: 0.85rem; text-decoration: underline;">Return to Queue</a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('cardNumber').addEventListener('input', function (e) {
        // Buang semua karakter selain nombor
        let val = this.value.replace(/\D/g, ''); 
        
        // Pastikan maksimum 16 digit sahaja (sebelum dijarakkan)
        val = val.substring(0, 16); 
        
        // Masukkan jarak/space kosong setiap 4 digit
        this.value = val.replace(/(.{4})/g, '$1 ').trim(); 
    });
</script>
@endsection