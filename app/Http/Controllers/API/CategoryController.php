<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
            'data' => Category::with([
                'owner',
                'branch'
            ])->latest()->get()
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
            ->where(
                'owner_id',
                auth()->id()
            )
            ->latest()
            ->get()
        ]);
    }

    /**
     * Create Category
     */
    public function store(Request $request)
    {
        $request->validate([
            'owner_id'  => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'name'      => 'required|max:255',
            'image'     => 'nullable|image'
        ]);

        $image = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image')
                ->store(
                    'categories',
                    'public'
                );
        }

        $category = Category::create([
            'owner_id'   => $request->owner_id,
            'branch_id'  => $request->branch_id,
            'name'       => $request->name,
            'description'=> $request->description,
            'image'      => $image,
            'is_active'  => 1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    /**
     * Show Category
     */
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category->load([
                'owner',
                'branch'
            ])
        ]);
    }

    /**
     * Update Category
     */
    public function update(
        Request $request,
        Category $category
    )
    {
        $request->validate([
            'owner_id'  => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'name'      => 'required|max:255',
            'image'     => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {

            if (
                $category->image &&
                Storage::disk('public')
                ->exists($category->image)
            ) {

                Storage::disk('public')
                    ->delete($category->image);
            }

            $image = $request->file('image')
                ->store(
                    'categories',
                    'public'
                );

            $category->image = $image;
        }

        $category->update([
            'owner_id'   => $request->owner_id,
            'branch_id'  => $request->branch_id,
            'name'       => $request->name,
            'description'=> $request->description,
            'is_active'  => $request->is_active ?? 1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category->fresh()
        ]);
    }

    /**
     * Delete Category
     */
    public function destroy(
        Category $category
    )
    {
        $category->update([
            'is_active' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category deactivated successfully'
        ]);
    }
}