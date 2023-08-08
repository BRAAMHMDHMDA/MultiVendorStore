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
    Route::get('products/datatable', [ProductController::class, 'datatable'])->name('products.datatable');
    Route::get('products/datatableTrashed', [ProductController::class, 'datatableTrashed'])->name('products.datatableTrashed');
    Route::get('products/trash',[ProductController::class, 'trash'])->name('products.trash');
    Route::put('products/trash/{id?}',[ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/trash/{id?}',[ProductController::class, 'forceDelete'])->name('products.force-delete');
    Route::resource('products',ProductController::class);

    // Routes Stores
    Route::resource('stores', StoreController::class);

});
