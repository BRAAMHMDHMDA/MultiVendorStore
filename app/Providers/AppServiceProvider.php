<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
    //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();

        $this->bootSettings();
    }

    public function bootSettings(): void
    {
        $settings = Cache::get('app-settings');

        if (!$settings){
            $settings = Setting::all();
            Cache::put('app-settings', $settings);
        }

        foreach ($settings as $setting){
            if ($setting->value !== null){
                Config::set($setting->name, $setting->value);
            }
        }

    }
}
