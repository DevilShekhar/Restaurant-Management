<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PermissionWebController extends Controller
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
        $response = $this->apiGet('/permissions');

        if (!$response->successful()) {

            return back()->with(
                'error',
                'Unable to fetch permissions.'
            );
        }

        $permissions = $response->json('data', []);

        return view(
            'permissions.index',
            compact('permissions')
        );
    }
    public function create()
{
return view('permissions.create');
}

public function store(Request $request)
{
$request->validate([
'name' => 'required'
]);


$response = Http::withToken(
    $this->token()
)->post(
    config('services.api.url') . '/permissions',
    [
        'name' => $request->name
    ]
);

if ($response->successful()) {

    return redirect()
        ->route('permissions.index')
        ->with(
            'success',
            'Permission Created Successfully'
        );
}

return back()
    ->withInput()
    ->with(
        'error',
        $response->json('message')
        ?? 'Failed To Create Permission'
    );


}


    public function edit($id)
    {
        $response = $this->apiGet(
            "/permissions/{$id}"
        );

        if (!$response->successful()) {

            return redirect()
                ->route('permissions.index')
                ->with(
                    'error',
                    'Unable to fetch permission.'
                );
        }

        $permission = $response->json(
            'permission'
        );

        return view(
            'permissions.edit',
            compact('permission')
        );
    }

    public function update(
        Request $request,
        $id
    )
    {
        $request->validate([
            'name' => 'required'
        ]);

        $response = Http::withToken(
            $this->token()
        )->put(
            config('services.api.url')
            . "/permissions/{$id}",
            [
                'name' => $request->name
            ]
        );

        if ($response->successful()) {

            return redirect()
                ->route('permissions.index')
                ->with(
                    'success',
                    'Permission Updated Successfully'
                );
        }

        return back()->with(
            'error',
            $response->json('message')
            ?? 'Failed To Update Permission'
        );
    }

    public function destroy($id)
    {
        $response = Http::withToken(
            $this->token()
        )->delete(
            config('services.api.url')
            . "/permissions/{$id}"
        );

        if ($response->successful()) {

            return redirect()
                ->route('permissions.index')
                ->with(
                    'success',
                    'Permission Deleted Successfully'
                );
        }

        return back()->with(
            'error',
            'Failed To Delete Permission'
        );
    }
}
