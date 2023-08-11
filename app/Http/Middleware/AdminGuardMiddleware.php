<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminGuardMiddleware
{

    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admins')->check()) return abort('403');
        return $next($request);
    }
}
