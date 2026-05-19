<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // Enforce boundary limits to prevent database query offset spikes
        if ($request->integer('orders_page', 1) > 1000 || $request->integer('products_page', 1) > 1000) {
            abort(400, 'Pagination boundary exceeded.');
        }

        $orders = Order::with('user')->latest()->paginate(15, ['*'], 'orders_page');
        $products = Product::with('category')->paginate(20, ['*'], 'products_page');
        $orderStats = [
            'total' => Order::count(),
            'queued' => Order::where('status', 'queued')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
        ];
        return view('admin.dashboard', compact('orders', 'products', 'orderStats'));
    }
}
