<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SetFortifyGuard
{

    public function handle(Request $request, Closure $next)
    {
        $admins = Auth::guard('admins')->check();
        $vendors = Auth::guard('vendors')->check();

        if (!$request->is('dashboard/*')&&!$request->is('broadcasting/auth')) {
            Config::set('fortify.guard', 'web');
        }elseif ($request->guard === 'admin' || $admins){
            Config::set('fortify.guard', 'admins');
        }elseif ($request->guard === 'vendor' || $vendors){
            Config::set('fortify.guard', 'vendors');
        }

        return $next($request);
    }
}
