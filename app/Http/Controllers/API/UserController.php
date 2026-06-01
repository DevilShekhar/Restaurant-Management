<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return User::with('roles')->paginate(20);
    }

    public function store(Request $request)
    {
        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)

        ]);

        $user->assignRole($request->role);

        return response()->json([
            'message' => 'User Created',
            'user' => $user
        ]);
    }

    public function show(User $user)
    {
        return $user->load('roles');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}