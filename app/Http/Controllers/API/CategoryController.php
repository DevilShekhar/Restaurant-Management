<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CategoryController extends Controller
{
    /**
        * Category List
    */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Category::with(['owner','branch'])->latest()->get()
        ]);
    }
    /**
        * Create Category Data
    */
    public function create()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'branches' => Branch::where(
                    'is_active',1
                )
                ->select('id','name','owner_id')->get()
            ]
        ]);
    }
    /**
        * Owner Categories
    */
    public function myCategories()
    {
        return response()->json([
            'success' => true,
            'data' => Category::with([
                'branch'
            ])
            ->where( 'owner_id',auth()->id())->latest()->get()
        ]);
    }
    /**
        * Create Category
    */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name'      => 'required|max:255',        
        ]);      
        $category = Category::create([
            'owner_id'    => auth()->id(),
            'branch_id'   => $request->branch_id,
            'name'        => $request->name,
            'description' => $request->description,      
            'is_active'   => 1
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data'    => $category
        ], 201);
    }
    /**
        * Edit Category
    */
    public function edit(Category $category)
    {
        return response()->json([
        'success' => true,'data' => $category->load(['owner','branch'])]);
    }
    /**
        * Show Category
    */
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category->load(['owner','branch'])
        ]);
    }
    /**
        * Update Category
    */
    public function update(Request $request,Category $category)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name'      => 'required|max:255',
        ]);        
        $updateData = [
            'owner_id'    => auth()->id(),
            'branch_id'   => $request->branch_id,
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->is_active ?? 1
        ];
        $category->update($updateData );
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data'    => $category->fresh()
        ]);       
    }
    /**
        * Delete Category
    */
    public function destroy(Category $category)
    {
        $category->update(['is_active' => 0]);
        return response()->json(['success' => true,'message' => 'Category deactivated successfully']);
    }
}