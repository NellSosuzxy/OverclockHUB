@extends('layouts.app')

@section('content')
    <div style="max-width: 500px; margin: 4rem auto;">
        <div style="background-color: var(--bg-card); border: 1px solid var(--danger); padding: 3rem;">
            <h2 style="text-align: center; margin-bottom: 0.5rem; color: var(--danger);">ROOT <span style="color: var(--text-main);">ACCESS</span></h2>
            <p style="text-align: center; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 2.5rem;">Administrative authentication required</p>

            <form method="POST" action="{{ route('admin.authenticate') }}">
                @csrf

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Admin Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="root@overclockhub.com">

                <label style="display:block; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">Root Key</label>
                <input type="password" name="password" class="form-control" required placeholder="Enter root key...">

                <button type="submit" class="btn btn-primary w-100" style="background-color: var(--danger); margin-top: 0.5rem;">Authenticate <i data-lucide="chevron-right" style="width: 1.2rem; height: 1.2rem; margin-left: 0.5rem;"></i></button>
            </form>
        </div>
    </div>
@endsection
