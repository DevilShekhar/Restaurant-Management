<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Get All Users
     */
    public function index()
    {
        $users = User::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'User List',
            'data' => $users
        ]);
    }

    /**
     * Store New User
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        // dd($request->all());
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
=======
        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'role' => $request->role,

            'password' => Hash::make($request->password),

        ]);

        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'data' => $user
>>>>>>> 4a09523850cfeebdfa692b54279caaa0c7c1689b
        ]);
    }

    /**
     * Show Single User
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {

            return response()->json([
                'status' => false,
                'message' => 'User Not Found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $user
        ]);
    }

    /**
     * Update User
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {

            return response()->json([
                'status' => false,
                'message' => 'User Not Found'
            ], 404);
        }

        $user->update([

            'name' => $request->name,

            'email' => $request->email,

            'role' => $request->role,

        ]);

        return response()->json([
            'status' => true,
            'message' => 'User Updated Successfully',
            'data' => $user
        ]);
    }

    /**
     * Delete User
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {

            return response()->json([
                'status' => false,
                'message' => 'User Not Found'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User Deleted Successfully'
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 4a09523850cfeebdfa692b54279caaa0c7c1689b
