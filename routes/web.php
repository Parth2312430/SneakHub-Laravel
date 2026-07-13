<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SneakHubController;
use App\Http\Controllers\ProductApiController;  
use App\Http\Controllers\CategoryApiController; 
use App\Http\Controllers\BrandApiController;   
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\AdminOrderController;

/*
|--------------------------------------------------------------------------
| Laravel Default Welcome Page
|--------------------------------------------------------------------------
*/
Route::get('/', [SneakHubController::class, 'home'])->name('home');
Route::get('/home', function () {
    return redirect()->route('home');
});

/*
|--------------------------------------------------------------------------
| API Routes (Exposing Data for Modules)
|--------------------------------------------------------------------------
*/
// Products API
Route::get('/api/products', [ProductApiController::class, 'index']);
Route::get('/api/products/{id}', [ProductApiController::class, 'show']);

// Categories API
Route::get('/api/categories', [CategoryApiController::class, 'index']);
Route::get('/api/categories/{id}', [CategoryApiController::class, 'show']);

// Brands API
Route::get('/api/brands', [BrandApiController::class, 'index']);
Route::get('/api/brands/{id}', [BrandApiController::class, 'show']);


/*
|--------------------------------------------------------------------------
| SneakHub Public Pages
|--------------------------------------------------------------------------
*/
Route::get('/shop', [SneakHubController::class, 'products'])->name('products');
Route::get('/contact', [SneakHubController::class, 'contact'])->name('contact');
Route::get('/product/{id}', [SneakHubController::class, 'productDetails'])->name('product.details');
Route::get('/my-orders', [SneakHubController::class, 'myOrders'])->middleware('auth')->name('my.orders');

/*
|--------------------------------------------------------------------------
| Review & Cart Routes
|--------------------------------------------------------------------------
*/
Route::post('/review/{product}', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');

Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success', function() {
    return view('pages.checkout-success');
})->name('checkout.success');


/*
|--------------------------------------------------------------------------
| Laravel Auth & Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->user()->email !== 'admin123@example.com') {
        return redirect()->route('home')->with('error', 'Access denied. You do not have administrator privileges.');
    }
    $totalRevenue = \App\Models\Order::sum('total_price');
    $totalOrders = \App\Models\Order::count();
    $outOfStock = \App\Models\Product::where('stock', '<=', 0)->count();
    $recentOrders = \App\Models\Order::orderBy('created_at', 'desc')->take(5)->get();

    return view('dashboard', compact('totalRevenue', 'totalOrders', 'outOfStock', 'recentOrders'));
})->middleware(['auth', 'verified'])->name('dashboard');

// === USER PROFILE ROUTES ===
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// === ADMIN ROUTES GROUP ===
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    // AJAX Search for products in admin (MUST be before resource route)
    Route::get('/admin/products/search', [AdminProductController::class, 'search'])->name('admin.products.search');

    // Module 1: Products
    Route::resource('admin/products', AdminProductController::class)
        ->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]);

    // Module 2: Categories
    Route::resource('admin/categories', AdminCategoryController::class)
        ->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]);

    // AJAX Search for Brands in admin (MUST be before resource route)
    Route::get('/admin/brands/search', [AdminBrandController::class, 'search'])->name('admin.brands.search');

    // Module 3: Brands
    Route::resource('admin/brands', AdminBrandController::class)
        ->names([
            'index' => 'admin.brands.index',
            'create' => 'admin.brands.create',
            'store' => 'admin.brands.store',
            'edit' => 'admin.brands.edit',
            'update' => 'admin.brands.update',
            'destroy' => 'admin.brands.destroy',
        ]);

    // Module 4: Orders
    Route::resource('admin/orders', AdminOrderController::class)
        ->only(['index', 'show', 'update'])
        ->names([
            'index' => 'admin.orders.index',
            'show' => 'admin.orders.show',
            'update' => 'admin.orders.update',
        ]);
});

require __DIR__.'/auth.php';