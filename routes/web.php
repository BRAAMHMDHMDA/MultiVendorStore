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
    WishlistController,
    PaymentsController,
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

Route::get('/contactUs', [ContactUsController::class, 'create'])->name('contact-us');
Route::post('/contactUs', [ContactUsController::class, 'store']);

Route::get('/aboutUs', AboutUsController::class)->name('about-us');

Route::get('/search', [ProductController::class, 'search'])->name('search-page');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist', [WishlistController::class, 'store']);
Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy']);


// Website Protected Routes
Route::group([
    'middleware' => ['auth:web'],
], function () {
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store']);

//    Route::get('/orders/{order}/pay', [PaymentsController::class, 'create'])->name('orders.payments.create');
//    Route::post('/orders/{order}/stripe/payment-intent', [PaymentsController::class, 'createStripePaymentIntent'])->name('stripe.paymentIntent.create');
//    Route::get('/orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])->name('stripe.return');
    Route::get('orders/{order}/pay', [PaymentsController::class, 'create'])
        ->name('orders.payments.create');

    Route::post('orders/{order}/stripe/payment-intent', [PaymentsController::class, 'createStripePaymentIntent'])
        ->name('stripe.paymentIntent.create');

    Route::get('orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])
        ->name('stripe.return');

    Route::get('account', [\App\Http\Controllers\Website\AccountController::class, 'index'])
        ->name('account');
});

//// Dashboard Routes
//require __DIR__.'/dashboard.php';

