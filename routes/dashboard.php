<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    CategoryController,
    BrandController,
    TagController,
    ProductController,
    StoreController,
};


Route::group([
  'middleware' => [],
  'as' => 'dashboard.',
  'prefix' => 'dashboard',
], function (){

    // Routes Categories
    Route::get('categories/dt', [CategoryController::class, 'dt'])->name('category.dt');

    Route::resource('categories', CategoryController::class)->except('show');

    // Routes Brands
    Route::resource('brands', BrandController::class)->except('show');

    // Routes Tags
    Route::resource('tags', TagController::class)->except('show');

    // Routes Products
    Route::get('products/data', [ProductController::class, 'data'])->name('product.data');
    Route::resource('products', ProductController::class);

    // Routes Stores
    Route::resource('stores', StoreController::class);

});
