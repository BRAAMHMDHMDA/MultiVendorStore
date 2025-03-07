<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreOwnerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return Auth::guard('vendors')->user()?->is_owner !== 1 ? throw new AuthorizationException() : $next($request);
    }
}
