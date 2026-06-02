<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RoleWebController extends Controller
{
    private function token()
    {
        return session('jwt_token');
    }

    private function apiGet($url)
    {
        return Http::withToken($this->token())
            ->acceptJson()
            ->get(config('services.api.url') . $url);
    }

    public function index()
    {
        $response = $this->apiGet('/roles');

        if (!$response->successful()) {
            return back()->with('error', 'Unable to fetch roles.');
        }

        // API returns plain array
        $roles = $response->json();

        return view('roles.index', compact('roles'));
    }

    public function show($id)
    {
        $response = $this->apiGet("/roles/{$id}/permissions");

        if (!$response->successful()) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'Unable to fetch permissions.');
        }

        $role = $response->json('role');
        $permissions = $response->json('role_permissions', []);

        return view('roles.show', compact('role', 'permissions'));
    }
    public function editPermissions($id)
    {
        $response = $this->apiGet("/roles/{$id}/permissions");

        if (!$response->successful()) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'Unable to fetch permissions');
        }

        $role = $response->json('role');
        $permissions = $response->json('permissions', []);
        $rolePermissions = $response->json('role_permissions', []);

        return view(
            'roles.permissions',
            compact(
                'role',
                'permissions',
                'rolePermissions'
            )
        );
    }

    public function updatePermissions($id)
    {
        $response = Http::withToken($this->token())
            ->post(
                config('services.api.url') .
                "/roles/{$id}/permissions",
                [
                    'permissions' => request('permissions', [])
                ]
            );

        if ($response->successful()) {
            return redirect()
                ->route('roles.index')
                ->with(
                    'success',
                    'Role Permissions Updated Successfully'
                );
        }

        return back()->with(
            'error',
            'Failed To Update Permissions'
        );
    }
    
}