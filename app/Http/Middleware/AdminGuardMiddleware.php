<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class AdminGuardMiddleware
{

    public function handle($request, Closure $next)
    {
        return !Auth ::guard('admins')->check() ? throw new AuthorizationException() : $next($request);
    }
}
