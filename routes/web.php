<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\{
    HomeController,
    ProductController,
    StoreController,
    CartController,
};



// Website Public Routes
Route::get('/', HomeController::class)->name('home');
Route::redirect('/home', '/');

Route ::get('/products', [ProductController::class, 'index']) -> name('all-products');
Route ::get('/product/{product:slug}', [ProductController::class, 'show']) -> name('product-details');

Route ::get('/stores', [StoreController::class, 'index']) -> name('all-stores');
Route ::get('/store/{store:slug}', [StoreController::class, 'show']) -> name('store-details');

Route::resource('cart', CartController::class)->except(['create', 'edit']);

// Website Protected Routes
Route::group([
    'middleware' => ['auth:web'],
], function () {

});

// Dashboard Routes
require __DIR__.'/dashboard.php';

