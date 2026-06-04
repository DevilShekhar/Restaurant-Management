<?php

namespace App\Http\Controllers\Admin;
use App\Models\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class CategoryWebController extends Controller
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
        return Http::withToken($this->token())->acceptJson()->get(config('services.api.url') . $url);
    }
    /**
     * Super Admin Categories
     */
    public function index()
    {
        $response = $this->apiGet('/categories');
        if (!$response->successful()) {
            return back()->with('error','Unable to fetch categories.');
        }
        $categories = json_decode(
            json_encode(
                $response->json('data', [])
            )
        );
        return view('categories.index',compact('categories'));
    }
    /**
     * Owner Categories
     */
    public function myCategories()
    {
        $response = $this->apiGet('/my-categories');
        if (!$response->successful()) {
            return back()->with('error','Unable to fetch categories.');
        }
        $categories = json_decode(
            json_encode(
                $response->json('data', [])
            )
        );
        return view('categories.mycategories',compact('categories'));
    }

    /**
        * Create Form
    */
    public function create()
    {
        $response = $this->apiGet('/categories/create');
        $branches = json_decode(
            json_encode(
                $response->json(
                    'data.branches',
                    []
                )
            )
        );
        return view('categories.create',compact('branches'));
    }

    /**
        * Store Category
    */
    public function store(Request $request)
    {
        $response = Http::withToken($this->token())->post(config('services.api.url'). '/categories',[
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'description' => $request->description
        ]);
        if ($response->successful()) {
            return redirect()->route('categories.index')->with('success','Category Created Successfully');
        }
        return back()->withInput()->withErrors($response->json('errors')?? ['error' => $response->json('message') ]);
    }

    /**
     * Show Category
     */
    public function show($id)
    {
        $response = $this->apiGet("/categories/{$id}");
        if (!$response->successful()) {
            return redirect()->route('categories.index');
        }
        $category = json_decode(
            json_encode(
                $response->json('data')
            )
        );
        return view('categories.show',compact('category'));
    }

    /**
        * Edit Form
    */
    public function edit($id)
    {
        $response = $this->apiGet("/categories/{$id}");
        if (!$response->successful()) {
            return redirect()->route('categories.index')->with('error','Category Not Found');
        }
        $category = json_decode(
            json_encode(
                $response->json('data')
            )
        );
        $branchResponse = $this->apiGet('/categories/create');
        $branches = json_decode(
            json_encode(
                $branchResponse->json(
                    'data.branches',
                    []
                )
            )
        );
        return view('categories.edit',compact('category','branches'));
    }

    /**
     * Update Category
     */
    public function update(Request $request,$id)
    {
        $response = Http::withToken($this->token())->put(config('services.api.url'). "/categories/{$id}",[
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active
        ]);
        if ($response->successful()) {
            return redirect()->route('categories.index')->with('success','Category Updated Successfully');
        }
        return back() ->withInput()->withErrors($response->json('errors')?? ['error' =>$response->json('message')]
        );
    }

    /**
     * Deactivate Category
     */
    public function destroy($id)
    {
        $response = Http::withToken($this->token())->delete(config('services.api.url'). "/categories/{$id}");

        if ($response->successful()) {
            return redirect()->route('categories.index')->with(
                'success',$response->json('message','Category Deactivated Successfully')
            );
        }
        return redirect()->route('categories.index')->with(
            'error',
            $response->json(
                'message',
                'Failed To Deactivate Category'
            )
        );
    }
}
