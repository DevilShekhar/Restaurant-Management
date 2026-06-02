<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json(
            Role::select(
                'id',
                'name'
            )->get()
        );
    }

    public function permissions(Role $role)
    {
        return response()->json([
            'success' => true,
            'role' => $role,
            'permissions' => Permission::all(),
            'role_permissions' => $role
                ->permissions
                ->pluck('name')
                ->toArray()
        ]);
    }

    public function updatePermissions(
        Request $request,
        Role $role
    )
    {
        $role->syncPermissions(
            $request->permissions ?? []
        );

        return response()->json([
            'success' => true,
            'message' => 'Role Permissions Updated Successfully'
        ]);
    }
}