<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Super Admin - All Branches
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Branch::with([
                'owner',
                'manager'
            ])->latest()->get()
        ]);
    }

    /**
     * Owner - My Branches
     */
    public function myBranches()
    {
        return response()->json([
            'success' => true,
            'data' => Branch::with([
                'owner',
                'manager'
            ])
            ->where('owner_id', auth()->id())
            ->latest()
            ->get()
        ]);
    }

    /**
     * Create Branch
     */
    public function store(Request $request)
    {
        $request->validate([
            'owner_id'       => 'required|exists:users,id',
            'name'           => 'required|string|max:255',
            'code'           => 'required|string|max:50|unique:branches,code',
            'phone'          => 'required|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address'        => 'required|string',
            'city'           => 'required|string|max:100',
            'state'          => 'required|string|max:100',
            'country'        => 'required|string|max:100',
            'postal_code'    => 'nullable|string|max:20',
            'gst_number'     => 'nullable|string|max:50',
            'fssai_license'  => 'nullable|string|max:50',
            'opening_time'   => 'required',
            'closing_time'   => 'required',
        ]);

        $data = $request->all();

        $data['is_active'] = 1;

        $branch = Branch::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Branch created successfully',
            'data' => $branch
        ], 201);
    }

    /**
     * Show Branch
     */
    public function show(Branch $branch)
    {
        return response()->json([
            'success' => true,
            'data' => $branch->load([
                'owner',
                'manager'
            ])
        ]);
    }

    /**
     * Update Branch
     */
    public function update(Request $request, Branch $branch)
    {
        $branch->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Branch updated successfully',
            'data' => $branch->fresh()
        ]);
    }

    /**
     * Deactivate Branch
     */
    public function destroy(Branch $branch)
    {
        $branch->update([
            'is_active' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Branch deactivated successfully'
        ]);
    }

    /**
     * Assign Branch Manager
     */
    public function assignManager(Request $request, Branch $branch)
    {
        $request->validate([
            'branch_manager_id' => 'required|exists:users,id'
        ]);

        $manager = User::findOrFail(
            $request->branch_manager_id
        );

        if ($manager->role !== 'branch_manager') {

            return response()->json([
                'success' => false,
                'message' => 'Selected user is not a branch manager'
            ], 422);
        }

        $branch->update([
            'branch_manager_id' => $manager->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Branch manager assigned successfully',
            'data' => $branch->fresh()->load([
                'owner',
                'manager'
            ])
        ]);
    }
    public function availableManagers()
    {
        $user = auth()->user();

        $managers = User::where('role', 'branch_manager')
            ->where('status', 'active')
            ->where('created_by', $user->id)
            ->select(
                'id',
                'name',
                'email',
                'phone'
            )
            ->get();

        return response()->json([
            'success' => true,
            'count'   => $managers->count(),
            'data'    => $managers
        ]);
    }
}