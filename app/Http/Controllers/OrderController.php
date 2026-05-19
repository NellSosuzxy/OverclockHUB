<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    private \App\Services\CartPricingService $pricingService;

    public function __construct(\App\Services\CartPricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    public function checkoutPage()
    {
        $user = Auth::user();
        if (trim((string) $user->address) === '') {
            return redirect()->route('profile.edit')->with('error', 'Please update your profile with a delivery address before proceeding to checkout.');
        }

        $cartItems = $user->cartItems()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your queue is empty.');
        }

        $pricing = $this->pricingService->calculatePricing(
            $cartItems,
            session('voucher_id')
        );

        $total = $pricing['total'];

        return view('checkout', compact('total'));
    }

    public function index()
    {
        $orders = Auth::user()->orders()->with('items')->latest()->paginate(10);
        return view('orders', compact('orders'));
    }

    public function store(\App\Http\Requests\StoreOrderRequest $request)
    {
        $user = Auth::user();
        
        if (trim((string) $user->address) === '') {
            return redirect()->route('profile.edit')->with('error', 'Please update your profile with a delivery address before proceeding to checkout.');
        }

        try {
            if (!$user || !\App\Models\User::where('id', $user->id)->exists()) {
                throw new \UnexpectedValueException('User account could not be structurally verified. Transaction aborted.');
            }

            $order = DB::transaction(function () use ($user, $request) {
                $cartItems = $user->cartItems()->get();

                if ($cartItems->isEmpty()) {
                    throw new \DomainException('Your queue is empty.');
                }

                $productIds = $cartItems->pluck('product_id');
                $products = \App\Models\Product::whereIn('id', $productIds)
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                $subtotal = 0;
                // Add the cart items but let pricing service recalculate subtotal along with shipping, discount.
                foreach ($cartItems as $cartItem) {
                    $product = $products->get($cartItem->product_id);
                    
                    if (!$product) {
                        throw new \UnexpectedValueException("A product in your cart (ID: {$cartItem->product_id}) no longer exists.");
                    }

                    if ($product->stock < $cartItem->quantity) {
                        throw new \App\Exceptions\InsufficientStockException("Insufficient stock for {$product->name}. Available: {$product->stock}.");
                    }
                    
                    // Explicitly link cart items to locked products for accurate pricing
                    $cartItem->setRelation('product', $product);
                }

                $pricing = app(\App\Services\CartPricingService::class)->calculatePricing(
                    $cartItems,
                    $request->session()->get('voucher_id'),
                    true // Lock voucher for update
                );

                $subtotal = $pricing['subtotal'];
                $discount = $pricing['discount'];
                $shippingFee = $pricing['shippingFee'];
                $total = $pricing['total'];
                $voucher = $pricing['appliedVoucher'];
                $voucherId = $voucher ? $voucher->id : null;

                $traceId = '#ORD-' . strtoupper(Str::random(8));

                $order = Order::create([
                    'user_id' => $user->id,
                    'trace_id' => $traceId,
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'shipping_fee' => $shippingFee,
                    'total' => $total,
                    'status' => 'queued',
                    'voucher_id' => $voucherId,
                ]);

                foreach ($cartItems as $cartItem) {
                    $product = $products->get($cartItem->product_id);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_price' => $product->price,
                        'quantity' => $cartItem->quantity,
                        'unit_price' => $product->price,
                    ]);

                    $product->stock -= $cartItem->quantity;
                    $product->save();
                }

                if ($voucherId && isset($voucher)) {
                    if ($voucher->max_uses !== null && $voucher->times_used >= $voucher->max_uses) {
                        throw new \DomainException("The voucher '{$voucher->code}' has reached its maximum usage limit.");
                    }
                    $voucher->increment('times_used');
                }

                $user->cartItems()->delete();

                return $order;
            });
            
            $request->session()->forget('voucher_id');

            return redirect()->route('order.success', $order);

        } catch (\App\Exceptions\InsufficientStockException | \DomainException $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        } catch (\UnexpectedValueException | \Exception $e) {
            return redirect()->route('cart.index')->with('error', 'A system error occurred during checkout. Please try again.');
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('order-success', compact('order'));
    }
}
