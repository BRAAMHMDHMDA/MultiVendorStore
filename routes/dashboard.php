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
    OrderController,
};

Route::redirect('/dashboard', '/dashboard/home');

Route::group([
  'middleware' => ['auth:admins,vendors'],
  'as' => 'dashboard.',
  'prefix' => 'dashboard',
], function (){
    Route::get('/home', function (){
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
    Route::patch('store/{store}/status', [StoreController::class, 'setStatus'])->name('store.status');

    // Routes Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    // Routes vendors
    Route::resource('vendors', VendorController::class);
    Route::patch('vendor/{vendor}/status', [VendorController::class, 'setStatus'])->name('vendor.status');

    // Routes admins
    Route::resource('admins', AdminController::class);
    Route::patch('admin/{admin}/status', [AdminController::class, 'setStatus'])->name('admin.status');

    // Routes Orders
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');



});
