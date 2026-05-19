<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $cartCount = 0;
            if (Auth::check()) {
                $cartCount = Auth::user()->cartItems()->sum('quantity');
            }
            $view->with('cartCount', $cartCount);
        });
    }
}
