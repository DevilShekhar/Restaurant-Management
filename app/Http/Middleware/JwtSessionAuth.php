<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtSessionAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('jwt_token')) {
            return redirect()->route('web.login.form');
        }

        return $next($request);
    }
}