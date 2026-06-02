<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function webLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!$token = auth('api')->attempt($credentials)) {
            return back()->with('error', 'Invalid Email or Password');
        }

        session([
            'jwt_token' => $token,
            'user' => auth('api')->user()
        ]);

        return redirect()->route('dashboard');
    }

        public function dashboard()
        {
            return view('dashboard');
        }

        public function logout()
    {
        try {
            if (session()->has('jwt_token')) {
                auth('api')
                    ->setToken(session('jwt_token'))
                    ->logout();
            }
        } catch (\Exception $e) {
        }

        session()->flush();

        return redirect()->route('login');
    }
}