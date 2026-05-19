<?php

namespace App\Services;

use App\Services\Pricing\SubtotalCalculator;
use App\Services\Pricing\ShippingCalculator;
use App\Services\Pricing\VoucherApplier;
use Illuminate\Support\Collection;

class CartPricingService
{
    protected SubtotalCalculator $subtotalCalculator;
    protected ShippingCalculator $shippingCalculator;
    protected VoucherApplier $voucherApplier;

    public function __construct(
        SubtotalCalculator $subtotalCalculator,
        ShippingCalculator $shippingCalculator,
        VoucherApplier $voucherApplier
    ) {
        $this->subtotalCalculator = $subtotalCalculator;
        $this->shippingCalculator = $shippingCalculator;
        $this->voucherApplier = $voucherApplier;
    }

    /**
     * Calculate the pricing details for a given collection of cart items.
     *
     * @param Collection $cartItems The cart items to calculate pricing for.
     * @param int|null $voucherId The ID of the voucher to apply, if any.
     * @param bool $lockVoucher Whether to lock the voucher row for update.
     * @return array Returns an array containing subtotal, discount, shippingFee, total, and appliedVoucher.
     */
    public function calculatePricing(Collection $cartItems, ?int $voucherId = null, bool $lockVoucher = false): array
    {
        $subtotal = $this->subtotalCalculator->calculate($cartItems);

        $voucherResult = $this->voucherApplier->apply($voucherId, $subtotal, $lockVoucher);
        $discount = $voucherResult['discount'];
        $appliedVoucher = $voucherResult['appliedVoucher'];

        $shippingFee = $this->shippingCalculator->calculate($subtotal);
        $total = max(0, $subtotal - $discount + $shippingFee);

        return [
            'subtotal'       => $subtotal,
            'discount'       => $discount,
            'shippingFee'    => $shippingFee,
            'total'          => $total,
            'appliedVoucher' => $appliedVoucher,
        ];
    }
}
