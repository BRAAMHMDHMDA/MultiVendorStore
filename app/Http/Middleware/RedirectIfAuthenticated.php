<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class RedirectIfAuthenticated
{
//    private function shouldRedirectToDashboard($guard): bool
//    {
//        return $this->isAuthenticated($guard) && $this->isAdminGuard($guard);
//    }
//
//    private function shouldRedirectToHome($guard): bool
//    {
//        return $this->isAuthenticated($guard) && !$this->isAdminGuard($guard);
//    }
//
//    private function isAuthenticated($guard): bool
//    {
//        if ($guard==='dashboard'){
//           return Auth::guard('admins')->check() || Auth::guard('vendors')->check();
//        }
//        return Auth::guard($guard)->check();
//    }
//    private function isAdminGuard($guard): bool
//    {
//        return in_array($guard, ['admins', 'vendors', 'dashboard']);
//    }

    private function isDashboard(): bool {return request()->is('dashboard/*');}
    private function guardAuth($guard): bool {return Auth::guard($guard)->check();}

    public function handle(Request $request, Closure $next, ...$guards)
    {

        $checkAuthInDashboard = $this->isDashboard() && ( $this->guardAuth('admins') || $this->guardAuth('vendors'));
        $checkAuthInWebsite = !$this->isDashboard() && $this->guardAuth('web');

        if ($checkAuthInDashboard) return redirect('dashboard');
        elseif ($checkAuthInWebsite) return redirect('/');

        return $next($request);

        //        $guard = Config::get('fortify.guard');
//
//        if ($this->shouldRedirectToDashboard($guard)) {
//            return redirect()->route('dashboard.home');
//        }elseif ($this->shouldRedirectToHome($guard)) {
//            return redirect()->route('home');
//        }
//
//        return $next($request);
//    }

        //--------------------------------------------------------------------------------

        //        $guards = empty($guards) ? [null] : $guards;
//
//        foreach ($guards as $guard) {
//            if (Auth::guard($guard) -> check()) {
//                return redirect(RouteServiceProvider::HOME);
//            }
//        }
//--------------------------------------------------------------------------------

    }
}
