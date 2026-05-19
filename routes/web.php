<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportTicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ==========================================
// Public Routes
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/policies', [HomeController::class, 'policies'])->name('policies');

// Throttle contact form submissions to prevent spam (5 requests per minute)
Route::post('/contact', [SupportTicketController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::get('/catalog/{category:slug}', [ProductController::class, 'index'])->name('catalog');

// ==========================================
// Authentication Routes (Laravel UI / Auth)
// ==========================================
Auth::routes();

// ==========================================
// Authenticated User Routes
// ==========================================
Route::middleware('auth')->group(function () {
    // User Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
