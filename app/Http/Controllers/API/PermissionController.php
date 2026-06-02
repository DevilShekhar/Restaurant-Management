<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Permission::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'api'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permission Created Successfully',
            'permission' => $permission
        ]);
    }

    public function show(Permission $permission)
    {
        return response()->json([
            'success' => true,
            'permission' => $permission
        ]);
    }

    public function update(
        Request $request,
        Permission $permission
    )
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permission Updated Successfully',
            'permission' => $permission
        ]);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json([
            'success' => true,
            'message' => 'Permission Deleted Successfully'
        ]);
    }
}