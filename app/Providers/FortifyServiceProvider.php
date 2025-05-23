<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\PasswordUpdateResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Config;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        if (request()->is('dashboard/*'))
        {
            Config::set('fortify.prefix', 'dashboard');
            Config::set('fortify.home', '/dashboard/home');
        }

        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request) {
                if (request()->is('dashboard/*')) {
                    return redirect()->intended(route('dashboard.home'));
                }
                return redirect()->intended('/');
            }
        });
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
            public function toResponse($request) {
                if (request()->is('dashboard/*')) {
                    return redirect()->intended(route('dashboard.home'));
                }
                return redirect()->intended(route('home'));
            }
        });
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request) {
                if (request()->is('dashboard/*')) {
                    return redirect()->intended(route('dashboard.home'));
                }
                return redirect()->intended(route('home'));
            }
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        if (request()->is('dashboard/*')) {
            Fortify::loginView('dashboard.content.authentications.login');
        } else{
            Fortify::loginView('website.content.auth.login');
            Fortify::registerView('website.content.auth.register');

        }

    }
}
