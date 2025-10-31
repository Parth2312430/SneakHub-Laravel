<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SneakHubController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController; // <-- 1. ADD THIS AT THE TOP
/*
|--------------------------------------------------------------------------
| Laravel Default Welcome Page (keep it)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| SneakHub API Route
|--------------------------------------------------------------------------
*/
// This route provides product data to your filterable shop page
Route::get('/api/products', [ProductApiController::class, 'index']);


/*
|--------------------------------------------------------------------------
| SneakHub Public Pages
|--------------------------------------------------------------------------
*/
Route::get('/home', [SneakHubController::class, 'home'])->name('home');
Route::get('/products', [SneakHubController::class, 'products'])->name('products');
Route::get('/contact', [SneakHubController::class, 'contact'])->name('contact');
Route::get('/product/{id}', [SneakHubController::class, 'productDetails'])->name('product.details');

/*
|--------------------------------------------------------------------------
| Review & Cart Routes
|--------------------------------------------------------------------------
*/

// Review Route
Route::post('/review/{product}', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');

// Cart Routes
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add'); // <-- This is the corrected line
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update'); // <-- This is the corrected line
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
// Add this with your other 'GET' routes
Route::get('/checkout/success', function() {
    return view('pages.checkout-success');
})->name('checkout.success');
/*
|--------------------------------------------------------------------------
| Laravel Auth & Dashboard Routes (keep these)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';