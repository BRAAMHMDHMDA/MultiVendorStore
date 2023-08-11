<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next, ...$guards)
    {
//        $guards = empty($guards) ? [null] : $guards;
//
//        foreach ($guards as $guard) {
//            if (Auth::guard($guard) -> check()) {
//                return redirect(RouteServiceProvider::HOME);
//            }
//        }
        $chcek = request()->is('dashboard/*') &&
            ( Auth::guard('admins')->check() || Auth::guard('vendors')->check());
        if ($chcek) {
            return redirect()->intended('dashboard');
        } elseif (Auth::guard('web')->check()){
            return redirect()->intended('/');
        }

        return $next($request);
    }
}
