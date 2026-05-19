<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class Money
{
    private int $amountInCents;
    private string $currency;

    public function __construct(int $amountInCents, string $currency = 'USD')
    {
        if ($amountInCents < 0) {
            throw new InvalidArgumentException('Amount cannot be negative');
        }
        $this->amountInCents = $amountInCents;
        $this->currency = $currency;
    }

    public function getAmount(): int
    {
        return $this->amountInCents;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function format(): string
    {
        return sprintf('%s %.2f', $this->currency, $this->amountInCents / 100);
    }
}