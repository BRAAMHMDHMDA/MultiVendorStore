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
        }else{
            Config::set('fortify.guard', 'vendors');
        }
        return $next($request);
    }
}
