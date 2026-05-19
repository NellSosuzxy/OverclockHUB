<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminVoucherController;
use App\Http\Controllers\Admin\AdminSupportTicketController;

// Public admin login accessible to guests
Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

// Admin authentication route, throttled to prevent brute-force attacks
Route::post('/admin/login', [AdminAuthController::class, 'authenticate'])
    ->middleware('throttle:5,1')
    ->name('admin.authenticate');

// Protected admin dashboard and resource management
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    // Admin Management Functions
    Route::put('/orders/{order}', [AdminOrderController::class, 'updateOrderStatus'])->name('orders.update');
    Route::get('/products/create', [AdminProductController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroyProduct'])->name('products.destroy');
    Route::get('/vouchers', [AdminVoucherController::class, 'vouchers'])->name('vouchers.index');

    // Support Ticket Functions
    Route::get('/support-tickets', [AdminSupportTicketController::class, 'supportTickets'])->name('tickets.index');
    Route::put('/support-tickets/{ticket}', [AdminSupportTicketController::class, 'updateTicketStatus'])->name('tickets.update');
});