<?php

namespace App\Services\Pricing;

class ShippingCalculator
{
    private const FREE_SHIPPING_THRESHOLD = 5000;
    private const SHIPPING_FEE = 85.00;

    public function calculate(float $subtotal): float
    {
        return $subtotal >= self::FREE_SHIPPING_THRESHOLD ? 0 : self::SHIPPING_FEE;
    }
}
