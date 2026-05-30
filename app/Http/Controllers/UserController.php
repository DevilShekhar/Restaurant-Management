<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display user list
     */
    public function index()
    {
            // dd(auth()->user());

        $users = User::latest()->get();
        // dd('ok');

        return view('users.index', compact('users'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        // dd('ok');
        return view('users.create');
    }

    /**
     * Store new user
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User Created Successfully');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User Updated Successfully');
    }

    /**
     * Delete user
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User Deleted Successfully');
    }
}
