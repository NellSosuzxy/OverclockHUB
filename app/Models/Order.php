<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Order
 *
 * Represents a customer's order.
 * Tracks pricing details (subtotal, shipping, discounts), status, and contains individual order items.
 *
 * @package App\Models
 */
class Order extends Model
{
    protected $fillable = [
        'user_id', 'trace_id', 'subtotal', 'discount',
        'shipping_fee', 'total', 'status', 'voucher_id',
    ];

    /**
     * Get the user who placed the order.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the voucher applied to the order, if any.
     *
     * @return BelongsTo
     */
    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    /**
     * Get the individual items that make up this order.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
