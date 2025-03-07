<?php

use Illuminate\Support\Facades\Auth;
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
    SettingsController,
    ContactController,
    HomeController,
    ADsController,
    TestimonialController,
    ProfileController,
    MyStoreController,
};
use Illuminate\Support\Facades\View;

Route::redirect('/dashboard', '/dashboard/home');

Route::group([
  'middleware' => ['auth:admins,vendors'],
  'as' => 'dashboard.',
  'prefix' => 'dashboard',
], function (){

    // Route Home Page
    Route::get('/home', [HomeController::class, 'show'])->name('home');

    Route::get('categories/dt', [CategoryController::class, 'dt'])->name('category.dt');
    Route::resource('categories', CategoryController::class)->except('show');

    // Routes Brands
    Route::resource('brands', BrandController::class)->except('show');

    // Routes ADs
    Route::resource('ADs', ADsController::class)->except('show');

    // Routes Testimonial
    Route::resource('testimonials', TestimonialController::class)->except('show');

    // Routes Tags
    Route::resource('tags', TagController::class)->except('show');

    // Routes Products
    Route::get('products/datatable', [ProductController::class, 'datatable'])->name('products.datatable');
    Route::get('products/datatableTrashed', [ProductController::class, 'datatableTrashed'])->name('products.datatableTrashed');
    Route::get('products/trash',[ProductController::class, 'trash'])->name('products.trash');
    Route::put('products/trash/{id?}',[ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/trash/{id?}',[ProductController::class, 'forceDelete'])->name('products.force-delete');
    Route::resource('products',ProductController::class);

    // Routes Manage Stores
    Route::resource('stores', StoreController::class);
    Route::patch('store/{store}/status', [StoreController::class, 'setStatus'])->name('store.status');

    // Routes Manage Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    // Routes Manage vendors
    Route::resource('vendors', VendorController::class);
    Route::patch('vendor/{vendor}/status', [VendorController::class, 'setStatus'])->name('vendor.status');

    // Routes Manage Admins
    Route::resource('admins', AdminController::class);
    Route::patch('admin/{admin}/status', [AdminController::class, 'setStatus'])->name('admin.status');

    // Routes Orders
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Routes Settings
    Route::get('settings/{group?}', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings/{group}', [SettingsController::class, 'update'])->name('settings.update');

    // Routes Contacts
    Route::resource('contacts', ContactController::class)->only('index', 'update', 'destroy');


    // Routes Notifications
    Route::get('notifications/read-all', function (){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications have been marked as read.');
    })->name('notifications.markAsRead');
    Route::get('/reRender-notification-menu', function (){
        $user = Auth::user();
        $notifications = $user->notifications()->take(10)->get();
        $newCount = $user->unreadNotifications()->count();

        // re Render the CartMenu component's view and return it as HTML
        $updatedNotificationHtml = View::make('components.dashboard.notifications-menu', compact('notifications', 'newCount'))->render();

        return $updatedNotificationHtml;
    });

    Route::get('profile', [ProfileController::class, 'index'])
        ->name('profile');
    Route::put('profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::patch('profile/change-password', [ProfileController::class, 'changePassword'])
        ->name('profile.change-password');

    Route::get('my-store', [MyStoreController::class, 'edit'])
        ->name('my-store');
    Route::put('my-store', [MyStoreController::class, 'update'])
        ->name('my-store.update');


});
