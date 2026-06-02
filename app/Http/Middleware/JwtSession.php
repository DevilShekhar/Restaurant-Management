<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtSession
{
    public function handle(Request $request, Closure $next)
    {
        $token = session('jwt_token');

        if (!$token) {
            return redirect()->route('login');
        }

        try {
            JWTAuth::setToken($token)->authenticate();
        } catch (\Exception $e) {
            session()->flush();
            return redirect()->route('login');
        }

        return $next($request);
    }
}