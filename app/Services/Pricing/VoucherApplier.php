<?php

namespace App\Services\Pricing;

use App\Models\Voucher;

class VoucherApplier
{
    public function apply(?int $voucherId, float $subtotal, bool $lockVoucher = false): array
    {
        $discount = 0;
        $appliedVoucher = null;

        if ($voucherId) {
            $query = Voucher::where('id', $voucherId);
            
            if ($lockVoucher) {
                $query->lockForUpdate();
            }

            $voucher = $query->first();

            if ($voucher && $voucher->isValid($subtotal)) {
                $appliedVoucher = $voucher;
                $discount = min($appliedVoucher->discount_amount, $subtotal);
            }
        }

        return [
            'discount'       => $discount,
            'appliedVoucher' => $appliedVoucher,
        ];
    }
}
