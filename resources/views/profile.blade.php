@extends('layouts.app')

@section('content')
    <h2 class="section-title">// Operator <span>Profile</span></h2>

    @if(session('error'))
    <div id="missing-info-modal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center; animation: fadeIn 0.3s ease-out;">
        <div style="background: var(--bg-card); border: 2px solid var(--danger); padding: 2.5rem; max-width: 500px; text-align: center; box-shadow: 0 0 30px rgba(255,51,51,0.2);">
            <h3 style="color: var(--danger); margin-top: 0;">// ACTION REQUIRED</h3>
            <p style="color: var(--text-main); margin-bottom: 2rem;">{{ session('error') }}</p>
            <button onclick="document.getElementById('missing-info-modal').remove(); document.getElementById('address-field').focus(); document.getElementById('address-field').style.boxShadow = '0 0 15px var(--accent)';" class="btn btn-outline" style="border-color: var(--accent); color: var(--accent);">Acknowledge & Update</button>
        </div>
    </div>
    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
    @endif

    <div class="grid-2">
        <div style="background-color: var(--bg-card); border: 1px solid var(--border); padding: 2.5rem;">
            <h3 style="margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem;">System Parameters</h3>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Operator Callsign</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Email (Read Only)</label>
                <input type="email" class="form-control" value="{{ $user->email }}" disabled style="opacity: 0.5;">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Comm Link (Phone)</label>
                <input type="text" name="phone" id="phone-field" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="+60 12-XXX XXXX">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Delivery Coordinates (Address)</label>
                <textarea name="address" id="address-field" class="form-control" rows="3" placeholder="Full shipping address..." style="transition: box-shadow 0.3s ease;">{{ old('address', $user->address) }}</textarea>

                <button type="submit" class="btn btn-primary w-100">Update Parameters</button>
            </form>
        </div>

        <div style="background-color: var(--bg-card); border: 1px solid var(--border); padding: 2.5rem;">
            <h3 style="margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem;">Security Key Reset</h3>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="name" value="{{ $user->name }}">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Current Security Key</label>
                <input type="password" name="current_password" class="form-control" placeholder="Enter current key...">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">New Security Key</label>
                <input type="password" name="new_password" class="form-control" placeholder="Minimum 8 characters...">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Confirm New Key</label>
                <input type="password" name="new_password_confirmation" class="form-control" placeholder="Re-enter new key...">

                <button type="submit" class="btn btn-danger w-100">Reset Security Key</button>
            </form>
        </div>
    </div>
@endsection
