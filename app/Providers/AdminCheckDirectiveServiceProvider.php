<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AdminCheckDirectiveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        // Admin
        Blade::directive('admin', function () {
            return "<?php if(Auth::guard('admins')->check()): ?>";
        });
        Blade::directive('endadmin', function () {
            return "<?php endif; ?>";
        });

        // Vendor
        Blade::directive('storeOwner', function () {
            return "<?php if(Auth::guard('vendors')->user()?->is_owner === 1): ?>";
        });
        Blade::directive('endStoreOwner', function () {
            return "<?php endif; ?>";
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
