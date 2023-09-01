<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\{
    HomeController,
    ProductController,
    StoreController,
    CartController,
    CurrencyConverterController,
    CheckoutController,
    ContactUsController,
    AboutUsController,
};

// Website Public Routes
Route::get('/home', HomeController::class)->name('home');
Route::redirect('/', '/home');

Route ::get('/products', [ProductController::class, 'index']) -> name('all-products');
Route ::get('/product/{product:slug}', [ProductController::class, 'show']) -> name('product-details');

Route ::get('/stores', [StoreController::class, 'index']) -> name('all-stores');
Route ::get('/store/{store:slug}', [StoreController::class, 'show']) -> name('store-details');

Route::resource('cart', CartController::class)->except(['create', 'edit']);
Route::get('/reRender-cart-menu', [CartController::class, 'reRenderCartMenu']);

Route::post('currency', CurrencyConverterController::class)->name('currency');

Route::get('/contactUs', [ContactUsController::class, 'index'])->name('contact-us');
Route::get('/aboutUs', AboutUsController::class)->name('about-us');


// Website Protected Routes
Route::group([
    'middleware' => ['auth:web'],
], function () {
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store']);
});

// Dashboard Routes
require __DIR__.'/dashboard.php';

