<?php

namespace App\Http\Middleware;

use Closure;

class JwtSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('jwt_token')) {
            return redirect('/login');
        }

        return $next($request);
    }
}