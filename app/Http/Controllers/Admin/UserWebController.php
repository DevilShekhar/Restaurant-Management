<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserWebController extends Controller
{
    /**
     * Get JWT Token
     */
    private function token()
    {
        return session('jwt_token');
    }
    private function apiGet($url)
    {
        return Http::withToken(session('jwt_token'))->acceptJson()->get(config('services.api.url') . $url);
    }
    
    /**
     * Display Users List
     */
    public function index()
    {
        $response = $this->apiGet('/users');
        if (!$response->successful()) {
            return back()->with('error', 'Unable to fetch users.');
        }
        $users = $response->json('data.data', []);
        return view('users.index', compact('users'));
    }
    /**
     * Show Create Form
     */
    public function create()
    {
        $response = $this->apiGet('/available-roles');
        $roles = $response->json('data', []);
        return view('users.create', compact('roles'));
    }
    /**
     * Store User
     */
    public function store(Request $request)
    {
        $http = Http::withToken($this->token());
        if ($request->hasFile('profile_photo')) {
            $http = $http->attach(
                'profile_photo',
                fopen($request->file('profile_photo')->getRealPath(), 'r'),
                $request->file('profile_photo')->getClientOriginalName()
            );
        }
        $response = $http->post(
            config('services.api.url') . '/users',
            [
                'name'                  => $request->name,
                'email'                 => $request->email,
                'phone'                 => $request->phone,
                'gender'                => $request->gender,
                'birth_date'            => $request->birth_date,
                'address'               => $request->address,
                'role'                  => $request->role,
                'password'              => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ]
        );
        if ($response->successful()) {
            return redirect()->route('users.index')->with('success', 'User Created Successfully');
        }
        return back()->withInput()->withErrors(
                $response->json('errors') ?? ['error' => $response->json('message')]
            );
    }
    /**
     * Show User Details
     */
    public function show($id)
    {
        $response = $this->apiGet("/users/{$id}");
        if (!$response->successful()) {
            return redirect()->route('users.index');
        }
        $user = $response->json('data');
        return view('users.show', compact('user'));
    }
    /**
     * Show Edit Form
     */
    public function edit($id)
    {
        $userResponse = $this->apiGet("/users/{$id}");
        if (!$userResponse->successful()) {
            return redirect()->route('users.index')->with('error', 'User Not Found');
        }
        $roleResponse = $this->apiGet('/available-roles');
        $user = $userResponse->json('data');
        $roles = $roleResponse->json('data', []);
        return view('users.edit', compact('user', 'roles'));
    }
    /**
     * Update User
     */
    public function update(Request $request, $id)
    {
        $http = Http::withToken($this->token());
        if ($request->hasFile('profile_photo')) {
            $http = $http->attach(
                'profile_photo',
                fopen($request->file('profile_photo')->getRealPath(), 'r'),
                $request->file('profile_photo')->getClientOriginalName()
            );
        }
        $response = $http->post(
            config('services.api.url') . "/users/{$id}",
            [
                '_method'    => 'PUT',
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'gender'     => $request->gender,
                'birth_date' => $request->birth_date,
                'address'    => $request->address,
                'role'       => $request->role,
                'status'     => $request->status,
            ]
        );
        if ($response->successful()) {
            return redirect()
                ->route('users.index')
                ->with('success', 'User Updated Successfully');
        }
        return back()
            ->withInput()
            ->withErrors(
                $response->json('errors')
                ?? ['error' => $response->json('message')]
            );
    }
    /**
     * Delete User
     */
    public function destroy($id)
    {
        $response = Http::withToken($this->token())
            ->delete(config('services.api.url') . "/users/{$id}");

        if ($response->successful()) {
            return redirect()
                ->route('users.index')
                ->with('success', 'User Deleted Successfully');
        }

        return redirect()
            ->route('users.index')
            ->with('error', $response->json('message', 'Failed To Delete User'));
    }
}