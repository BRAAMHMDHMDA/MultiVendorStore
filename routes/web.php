<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\{
    HomeController,
    ProductController,
    StoreController,
};

// Dashboard Routes

require __DIR__.'/dashboard.php';



// Website Routes

Route::get('/', HomeController::class)->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('all-products');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product-details');

Route::get('/stores', [StoreController::class, 'index'])->name('all-stores');
Route::get('/store/{store:slug}', [StoreController::class, 'show'])->name('store-details');



$controller_path = 'App\Http\Controllers';

Route::get('/login', function (){
    return view('website.content.auth.login');
});
Route::get('/register', function (){
    return view('website.content.auth.register');
});
Route::get('/page-2', $controller_path . '\pages\Page2@index')->name('pages-page-2');

// pages
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
