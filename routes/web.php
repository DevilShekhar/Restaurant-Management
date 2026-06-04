<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserWebController;
use App\Http\Controllers\Admin\RoleWebController;
use App\Http\Controllers\Admin\PermissionWebController;
use App\Http\Controllers\Admin\BranchWebController;
use App\Http\Controllers\Admin\CategoryWebController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {return view('auth.login');})->name('login');
    Route::post('/login', [AuthController::class, 'webLogin'])->name('web.login');
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('jwt.session')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [AuthController::class, 'dashboard']) ->name('dashboard');   
    /*
    |--------------------------------------------------------------------------
    | After Auth
    |--------------------------------------------------------------------------
    */
    Route::resource('users', UserWebController::class);
    Route::resource('roles', RoleWebController::class);
    Route::resource('permissions', PermissionWebController::class);
    Route::get('/roles/{id}/permissions',[RoleWebController::class,'editPermissions'])->name('roles.permissions.edit');
    Route::post('/roles/{id}/permissions',[RoleWebController::class,'updatePermissions'])->name('roles.permissions.update');
    Route::resource('branches', BranchWebController::class);
    Route::get('/my-branches',[BranchWebController::class, 'myBranches'])->name('branches.my');
    Route::post('/branches/{branch}/assign-manager',[BranchWebController::class, 'assignManager'])->name('branches.assign-manager');
    Route::resource('categories', CategoryWebController::class);
    Route::get('/my-categories',[CategoryWebController::class, 'myCategories'])->name('categories.my');
    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| Default Redirect
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/login');