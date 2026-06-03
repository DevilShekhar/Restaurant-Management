<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class BranchWebController extends Controller
{
    /**
     * JWT Token
     */
    private function token()
    {
        return session('jwt_token');
    }

    /**
     * Common GET API
     */
    private function apiGet($url)
    {
        return Http::withToken($this->token())
            ->acceptJson()
            ->get(config('services.api.url') . $url);
    }

    /**
     * Super Admin Branch List
     */
    public function index()
    {
        $response = $this->apiGet('/branches');

        if (!$response->successful()) {
            return back()->with(
                'error',
                'Unable to fetch branches.'
            );
        }

        $branches = $response->json('data', []);

        return view(
            'branches.index',
            compact('branches')
        );
    }

    /**
     * Owner Branch List
     */
    public function myBranches()
    {
        $response = $this->apiGet('/my-branches');

        if (!$response->successful()) {

            return back()->with(
                'error',
                'Unable to fetch branches.'
            );
        }

        $branches = json_decode(
            json_encode(
                $response->json('data', [])
            )
        );

        $managerResponse = $this->apiGet(
            '/available-managers'
        );

        $managers = json_decode(
            json_encode(
                $managerResponse->json('data', [])
            )
        );

        return view(
            'branches.mybranches',
            compact(
                'branches',
                'managers'
            )
        );
    }
    /**
     * Create Form
     */
    public function create()
    {
        $ownersResponse = $this->apiGet('/users');

        $owners = collect(
            $ownersResponse->json('data.data', [])
        )->where('role', 'owner');

        return view(
            'branches.create',
            compact('owners')
        );
    }

    /**
     * Store Branch
     */
    public function store(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post(
                config('services.api.url') . '/branches',
                $request->all()
            );

        if ($response->successful()) {

            return redirect()
                ->route('branches.index')
                ->with(
                    'success',
                    'Branch Created Successfully'
                );
        }

        return back()
            ->withInput()
            ->withErrors(
                $response->json('errors')
                ?? ['error' => $response->json('message')]
            );
    }

    /**
     * Show Branch
     */
    public function show($id)
    {
        $response = $this->apiGet(
            "/branches/{$id}"
        );

        if (!$response->successful()) {
            return redirect()
                ->route('branches.index');
        }

        $branch = $response->json('data');

        return view(
            'branches.show',
            compact('branch')
        );
    }

    /**
     * Edit Form
     */
    public function edit($id)
    {
        $branchResponse = $this->apiGet(
            "/branches/{$id}"
        );

        if (!$branchResponse->successful()) {

            return redirect()
                ->route('branches.index')
                ->with(
                    'error',
                    'Branch Not Found'
                );
        }

        $ownersResponse = $this->apiGet('/users');

        $owners = collect(
            $ownersResponse->json('data.data', [])
        )
        ->where('role', 'owner')
        ->map(function ($owner) {
            return (object) $owner;
        });

        $branch = json_decode(
            json_encode(
                $branchResponse->json('data')
            )
        );

        return view(
            'branches.edit',
            compact(
                'branch',
                'owners'
            )
        );
    }

    /**
     * Update Branch
     */
    public function update(Request $request, $id)
    {
        $response = Http::withToken($this->token())
            ->put(
                config('services.api.url')
                . "/branches/{$id}",
                $request->all()
            );

        if ($response->successful()) {

            return redirect()
                ->route('branches.index')
                ->with(
                    'success',
                    'Branch Updated Successfully'
                );
        }

        return back()
            ->withInput()
            ->withErrors(
                $response->json('errors')
                ?? ['error' => $response->json('message')]
            );
    }

    /**
     * Deactivate Branch
     */
    public function destroy($id)
    {
        $response = Http::withToken($this->token())
            ->delete(
                config('services.api.url')
                . "/branches/{$id}"
            );

        if ($response->successful()) {

            return redirect()
                ->route('branches.index')
                ->with(
                    'success',
                    'Branch Deactivated Successfully'
                );
        }

        return redirect()
            ->route('branches.index')
            ->with(
                'error',
                $response->json(
                    'message',
                    'Failed To Deactivate Branch'
                )
            );
    }

    /**
     * Assign Branch Manager
     */
    public function assignManager(
        Request $request,
        $id
    )
    {
        $response = Http::withToken(
            $this->token()
        )->post(
            config('services.api.url')
            . "/branches/{$id}/assign-manager",
            [
                'branch_manager_id'
                    => $request->branch_manager_id
            ]
        );

        if ($response->successful()) {

            return back()->with(
                'success',
                'Branch Manager Assigned Successfully'
            );
        }

        return back()->with(
            'error',
            $response->json('message')
        );
    }
    public function availableManagers()
{
    $managers = User::where('role', 'branch_manager')
        ->where('status', 'active')
        ->where('created_by', auth()->id())
        ->get();

    dd($managers);

    return response()->json([
        'success' => true,
        'data' => $managers
    ]);
}
}
