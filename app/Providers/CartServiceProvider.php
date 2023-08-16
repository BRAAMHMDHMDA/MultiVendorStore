<?php

namespace App\Providers;

use App\Repositories\Cart\CartInterfaceRepo;
use App\Repositories\Cart\CartModelRepo;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartInterfaceRepo::class, function() {
            return new CartModelRepo();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}