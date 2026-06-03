<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
{
    $authUser = auth()->user();

    $query = User::query();

    if ($authUser->role == 'super_admin') {

        $query->where('role', 'owner');

    } elseif ($authUser->role == 'owner') {

        $query->where('created_by', $authUser->id);

    } elseif ($authUser->role == 'branch_manager') {

        $query->where('created_by', $authUser->id)
              ->whereIn('role', [
                  'waiter_head',
                  'waiter',
                  'cashier'
              ]);
    }

    return response()->json([
        'success' => true,
        'data' => $query->latest()->paginate(20)
    ]);
}
    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'phone'                 => 'required|string|max:20',
            'gender'                => 'required|in:male,female,other',
            'profile_photo'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'birth_date'            => 'required|date',
            'address'               => 'required|string',
            'role'                  => 'required|string',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $profilePhoto = null;

        if ($request->hasFile('profile_photo')) {

            $profilePhoto = $request->file('profile_photo')
                ->store('profiles', 'public');
        }

        $user = User::create([
            'name'          => $validated['name'],
            'email'         => $validated['email'],
            'phone'         => $validated['phone'],
            'gender'        => $validated['gender'],
            'profile_photo' => $profilePhoto,
            'birth_date'    => $validated['birth_date'],
            'address'       => $validated['address'],
            'role'          => $validated['role'],
            'status'        => 'active',
            'password'      => Hash::make($validated['password']),
            'created_by'    => auth()->id(),
        ]);

        // Remove old roles and assign new role
        $user->syncRoles([$validated['role']]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user->fresh()->load('roles')
        ], 201);

    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'User fetched successfully',
            'data' => $user
        ], 200);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $id,
            'phone'         => 'required|string|max:20',
            'gender'        => 'required|in:male,female,other',
            'birth_date'    => 'required|date',
            'address'       => 'required|string',
            'role'          => 'required|string',
            'status'        => 'required|in:active,inactive',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {

            if (
                $user->profile_photo &&
                Storage::disk('public')->exists($user->profile_photo)
            ) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $profilePhoto = $request->file('profile_photo')
                ->store('profiles', 'public');

            $validated['profile_photo'] = $profilePhoto;
        }

        $validated['updated_by'] = auth()->id();

        $user->update($validated);

        // Remove old role and assign selected role
        $user->syncRoles([$validated['role']]);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user->fresh()->load('roles')
        ], 200);
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $user->update([
            'status' => 'inactive',
            'updated_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User deactivated successfully',
            'data' => $user->fresh()
        ], 200);
    }
    public function availableRoles()
    {
        $user = auth()->user();

        $roles = [];

        switch ($user->role) {

            case 'super_admin':
                $roles = [
                    'owner',                    
                ];
                break;

            case 'owner':
                $roles = [
                    'branch_manager',
                    'waiter_head',
                    'waiter',
                    'cashier'
                ];
                break;

            case 'branch_manager':
                $roles = [
                    'waiter_head',
                    'waiter',
                    'cashier'
                ];
                break;
        }

        return response()->json([
            'success' => true,
            'data' => $roles
        ]);
    }
}