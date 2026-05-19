<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private \App\Services\CartPricingService $pricingService;

    public function __construct(\App\Services\CartPricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    public function index(Request $request)
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        $pricing = $this->pricingService->calculatePricing(
            $cartItems,
            $request->session()->get('voucher_id')
        );

        // Highlight: Graceful "Phantom Voucher" fallback at render phase
        if ($request->session()->has('voucher_id') && !$pricing['appliedVoucher']) {
            $request->session()->forget('voucher_id');
        }

        $subtotal = $pricing['subtotal'];
        $discount = $pricing['discount'];
        $shippingFee = $pricing['shippingFee'];
        $total = $pricing['total'];
        $appliedVoucher = $pricing['appliedVoucher'];

        return view('cart', compact('cartItems', 'subtotal', 'discount', 'shippingFee', 'total', 'appliedVoucher'));
    }

    public function add(\App\Http\Requests\StoreCartRequest $request)
    {
        $validated = $request->validated();

        try {
            return \Illuminate\Support\Facades\DB::transaction(function () use ($validated) {
                $product = Product::find($validated['product_id']);

                if (!$product) {
                    throw new \UnexpectedValueException('Hardware registry entry no longer exists.');
                }

                $cartItem = CartItem::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->lockForUpdate()
                    ->first();

                $currentQty = $cartItem ? $cartItem->quantity : 0;

                if ($product->stock < 1 || $currentQty >= $product->stock) {
                    throw new \DomainException('Product is out of stock or quantity limit reached.');
                }

                if ($cartItem) {
                    $cartItem->quantity += 1;
                    $cartItem->save();
                } else {
                    CartItem::create([
                        'user_id' => Auth::id(),
                        'product_id' => $product->id,
                        'quantity' => 1,
                    ]);
                }

                return back()->with('success', 'Hardware added to queue.');
            });
        } catch (\DomainException | \UnexpectedValueException $e) {
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'A system error occurred while updating the queue.');
        }
    }

    public function update(\App\Http\Requests\UpdateCartRequest $request, CartItem $cartItem)
    {
        $validated = $request->validated();

        try {
            return \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $cartItem) {
                $lockedCartItem = CartItem::where('id', $cartItem->id)->lockForUpdate()->first();

                if (!$lockedCartItem || !$lockedCartItem->product) {
                    throw new \UnexpectedValueException('Queue item or related hardware no longer exists.');
                }

                $maxQty = $lockedCartItem->product->stock;
                $requestedQty = $validated['quantity'];

                $finalQty = min($requestedQty, $maxQty);

                if ($finalQty < 1) {
                    throw new \DomainException('Hardware is currently out of stock.');
                }

                $lockedCartItem->quantity = $finalQty;
                $lockedCartItem->save();

                if ($requestedQty > $maxQty) {
                    return redirect()->route('cart.index')
                        ->with('success', "Quantity adjusted to {$finalQty} (max available stock).");
                }

                return redirect()->route('cart.index')->with('success', 'Quantity updated.');
            });
        } catch (\DomainException | \UnexpectedValueException $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'A system error occurred while updating quantity.');
        }
    }

    public function destroy(\App\Http\Requests\DestroyCartRequest $request, CartItem $cartItem)
    {
        try {
            if (!$cartItem) {
                throw new \UnexpectedValueException('Queue item no longer exists.');
            }

            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from queue.');
            
        } catch (\DomainException | \UnexpectedValueException $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'A system error occurred while removing the item.');
        }
    }

    public function applyVoucher(\App\Http\Requests\ApplyVoucherRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $voucher = Voucher::where('code', $validated['voucher_code'])->first();

            if (!$voucher) {
                // Technically user error, but missing DB entity triggers our standard fallback logic
                throw new \UnexpectedValueException('Invalid or expired access code.');
            }
            
            if (!$voucher->isValid()) {
                throw new \DomainException('This access code is no longer valid or has reached its limits.');
            }

            $cartItems = Auth::user()->cartItems()->with('product')->get();
            $pricing = $this->pricingService->calculatePricing($cartItems);
            $subtotal = $pricing['subtotal'];

            if ($subtotal < $voucher->min_order_amount) {
                throw new \DomainException('Minimum order of RM ' . number_format($voucher->min_order_amount, 2) . ' required for this code.');
            }

            $request->session()->put('voucher_id', $voucher->id);
            $discount = min($voucher->discount_amount, $subtotal);
            
            return back()->with('success', 'Access code applied: -RM ' . number_format($discount, 2));
            
        } catch (\DomainException | \UnexpectedValueException $e) {
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'A system error occurred while validating the access code.');
        }
    }
}
