<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // dd('ok');
        return response()->json(Role::latest()->get());
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'api';
        $role->save();
        // dd($role);
        return response()->json([
            'message' => 'Role created successfully',
            'data' => $role
        ], 201);
    }

    public function show(Role $role)
    {
        return response()->json($role);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Role updated successfully',
            'data' => $role
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully'
        ]);
    }
}
