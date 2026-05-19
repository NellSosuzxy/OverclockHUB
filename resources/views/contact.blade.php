@extends('layouts.app')

@section('content')
<h2 class="section-title">// <span>Support</span> Terminal</h2>

<div class="grid-2">
    <div>
        <div style="background-color: var(--bg-card); border: 1px solid var(--border); padding: 2.5rem; margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1.5rem;">Submit Support Ticket</h3>
            <form method="POST" action="{{ route('contact.store') }}" onsubmit="this.querySelector('button').disabled = true; this.querySelector('button').innerHTML = 'TRANSMITTING...';">
                @csrf
                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Operator Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter callsign..." value="{{ old('name', Auth::user()->name ?? '') }}" required>

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Communication Channel (Email)</label>
                <input type="email" name="email" class="form-control" placeholder="secure@channel.com" value="{{ old('email', Auth::user()->email ?? '') }}" required>

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Reference ID (Optional)</label>
                <input type="text" name="reference_id" class="form-control" placeholder="#ORD-XXXX" value="{{ old('reference_id') }}">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Diagnostic Report</label>
                <textarea name="message" class="form-control" rows="5" placeholder="Describe the issue in detail..." required>{{ old('message') }}</textarea>

                <button type="submit" class="btn btn-primary w-100" style="padding: 1rem;">Transmit Report</button>
            </form>
        </div>
    </div>
    <div>
        <div style="background-color: var(--bg-card); border: 1px solid var(--border); padding: 2.5rem; position: sticky; top: 100px;">
            <h3 style="margin-bottom: 1.5rem;">Direct Channels</h3>
            <p style="color: var(--text-muted); margin-bottom: 1rem; font-size: 0.95rem;"><strong style="color:var(--text-main);">HQ Location:</strong><br>GSC Mid Valley Southkey, Lot LG045, Lower Ground Floor, Mid Valley Southkey, No 1 Persiaran Southkey 1 80150 Johor Bahru Johor</p>
            <p style="color: var(--text-muted); margin-bottom: 1rem; font-size: 0.95rem;"><strong style="color:var(--text-main);">Comm Link:</strong><br>+60 3-7486 0641</p>
            <p style="color: var(--text-muted); margin-bottom: 1rem; font-size: 0.95rem;"><strong style="color:var(--text-main);">Encrypted Mail:</strong><br>support@overclockhub.com</p>
            <p style="color: var(--text-muted); font-size: 0.95rem;"><strong style="color:var(--text-main);">Operational Hours:</strong><br>Mon-Fri: 0900-1800 MYT<br>Sat: 1000-1400 MYT</p>
        </div>
    </div>
</div>
@endsection