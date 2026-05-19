<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(\App\Http\Requests\AdminLoginRequest $request)
    {
        $validated = $request->validated();
        $email = Str::lower($validated['email']);

        $throttleKeyCombo = $email . '|' . $request->ip();
        $throttleKeyGlobal = $email . '|global_admin';

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKeyCombo, 5) || 
            \Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKeyGlobal, 15)) {
            $seconds = max(
                \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKeyCombo),
                \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKeyGlobal)
            );
            return back()->withErrors(['email' => "Too many login attempts. Please try again in {$seconds} seconds."]);
        }

        if (Auth::attempt(['email' => $email, 'password' => $validated['password']])) {
            \Illuminate\Support\Facades\RateLimiter::clear($throttleKeyCombo);
            \Illuminate\Support\Facades\RateLimiter::clear($throttleKeyGlobal);
            
            if (!Auth::user()->isAdmin()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Access denied. Root access only.']);
            }
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        \Illuminate\Support\Facades\RateLimiter::hit($throttleKeyCombo, 60);
        \Illuminate\Support\Facades\RateLimiter::hit($throttleKeyGlobal, 300);

        $remaining = \Illuminate\Support\Facades\RateLimiter::retriesLeft($throttleKeyCombo, 5);
        $attemptsMsg = $remaining > 0 ? "You have {$remaining} attempts remaining." : "Account locked.";

        return back()->withErrors(['email' => 'Invalid credentials. ' . $attemptsMsg]);
    }
}
