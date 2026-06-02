<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JwtSessionAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('jwt_token')) {
            return redirect()->route('web.login.form');
        }

        return $next($request);
    }
}