<?php

namespace App\Services\Pricing;

use Illuminate\Support\Collection;

class SubtotalCalculator
{
    public function calculate(Collection $cartItems): float
    {
        return $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
}
