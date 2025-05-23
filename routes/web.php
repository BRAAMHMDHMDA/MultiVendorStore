<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\{AboutUsController,
    CartController,
    CheckoutController,
    ContactUsController,
    CurrencyConverterController,
    HomeController,
    PaymentsController,
    ProductController,
    StoreController,
    WishlistController,
    AccountController
};
use App\Http\Livewire\Website\{
    Products\ProductsPage,
    Cart\CartPage,
    Wishlist,
    Products\ProductPage,
};


// Website Public Routes
Route::get('/home', HomeController::class)->name('home');
Route::redirect('/', '/home');

//Route ::get('/products', [ProductController::class, 'index']) -> name('all-products');
Route::get('/products', ProductsPage::class) -> name('all-products');
Route ::get('/product/{product:slug}', ProductPage::class) -> name('product-details');

Route ::get('/stores', [StoreController::class, 'index']) -> name('all-stores');
Route ::get('/store/{store:slug}', [StoreController::class, 'show']) -> name('store-details');

Route::resource('cart', CartController::class)->except(['create', 'edit']);
Route::get('cart', CartPage::class)->name('cart.index');
//Route::get('/reRender-cart-menu', [CartController::class, 'reRenderCartMenu']);

Route::post('currency', CurrencyConverterController::class)->name('currency');

Route::get('/contactUs', [ContactUsController::class, 'create'])->name('contact-us');
Route::post('/contactUs', [ContactUsController::class, 'store']);

Route::get('/aboutUs', AboutUsController::class)->name('about-us');

Route::get('/search', [ProductController::class, 'search'])->name('search-page');

Route::get('/wishlist', Wishlist::class)->name('wishlist');
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

    Route::get('account', [AccountController::class, 'index'])
        ->name('account');
    Route::put('account', [AccountController::class, 'update'])
        ->name('account.update');
    Route::patch('account/change-password', [AccountController::class, 'changePassword'])
        ->name('account.change-password');
});

//// Dashboard Routes
//require __DIR__.'/dashboard.php';

