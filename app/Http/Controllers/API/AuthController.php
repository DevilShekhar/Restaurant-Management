<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if (!$token = auth('api')->attempt($credentials)) {

            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials'
            ],401);

        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => auth('api')->user()
        ]);
    }

    public function profile()
    {
        return response()->json(
            auth('api')->user()
        );
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json([
            'message' => 'Logged Out'
        ]);
    }
}