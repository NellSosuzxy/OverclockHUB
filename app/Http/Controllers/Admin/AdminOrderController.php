<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function updateOrderStatus(\App\Http\Requests\UpdateOrderStatusRequest $request, Order $order)
    {
        try {
            $validated = $request->validated();
            
            if (!$order) {
                throw new \UnexpectedValueException('Order record no longer exists.');
            }

            $currentStatus = $order->status;
            $newStatus = $validated['status'];

            // Enforce state machine forward-progression
            $hierarchy = ['queued' => 1, 'shipped' => 2, 'delivered' => 3];

            if ($hierarchy[$newStatus] < $hierarchy[$currentStatus]) {
                throw new \DomainException("Invalid transition: Cannot downgrade order from '{$currentStatus}' back to '{$newStatus}'.");
            }

            $order->status = $newStatus;
            $order->save();

            return back()->with('success', 'Logistics status updated successfully.');
            
        } catch (\DomainException | \UnexpectedValueException $e) {
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'A system error occurred while updating the order status.');
        }
    }
}
