<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    CategoryController,
    BrandController,
    TagController,
    ProductController,
    StoreController,
    UserController,
    VendorController,
    AdminController,
};


Route::group([
  'middleware' => ['auth:admins,vendors'],
  'as' => 'dashboard.',
  'prefix' => 'dashboard',
], function (){
    Route::get('/', function (){
        return view('dashboard.content.pages.pages-home');
    })->name('home');

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

    // Routes Users
    Route::get('users', [UserController::class, 'index'])->name('user.index');

    // Routes vendors
    Route::get('vendors', [VendorController::class, 'index'])->name('vendor.index');

    // Routes admins
    Route::get('admins', [AdminController::class, 'index'])->name('admin.index');


});
