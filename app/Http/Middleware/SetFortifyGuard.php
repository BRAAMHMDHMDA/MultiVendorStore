<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SetFortifyGuard
{

    public function handle(Request $request, Closure $next)
    {
        if (!$request->is('dashboard/*')) {
            Config::set('fortify.guard', 'web');
        }elseif ($request->guard === 'admin'){
            Config::set('fortify.guard', 'admins');
        }elseif ($request->guard === 'vendors'){
            Config::set('fortify.guard', 'vendors');
        }elseif ($request->is('dashboard/*') && !$request->guard){
            Config::set('fortify.guard', 'dashboard');
        }

        return $next($request);
    }
}
