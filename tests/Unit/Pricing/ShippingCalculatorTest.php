<?php

namespace Tests\Unit\Pricing;

use PHPUnit\Framework\TestCase;
use App\Services\Pricing\ShippingCalculator;

class ShippingCalculatorTest extends TestCase
{
    public function test_it_charges_shipping_fee_below_threshold()
    {
        $calculator = new ShippingCalculator();
        $this->assertEquals(85.00, $calculator->calculate(4999.99));
    }

    public function test_it_provides_free_shipping_above_threshold()
    {
        $calculator = new ShippingCalculator();
        $this->assertEquals(0, $calculator->calculate(5000.00));
        $this->assertEquals(0, $calculator->calculate(6000.00));
    }
}
