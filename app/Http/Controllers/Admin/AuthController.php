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

        if (!$token = auth()->attempt($credentials)) {
            return back()->with('error', 'Invalid Email or Password');
        }

        session([
            'jwt_token' => $token,
            'user' => auth()->user()
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
                auth()->setToken(session('jwt_token'))->logout();
            }
        } catch (\Exception $e) {
            // optional: log error
        }

        session()->flush();

        return redirect()->route('web.login.form');
    }
}