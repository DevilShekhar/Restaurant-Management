<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\PermissionController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->name('api.')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('users', UserController::class);

    Route::get('available-roles', [UserController::class, 'availableRoles']);
     Route::get('/roles', [RoleController::class,'index']);
        Route::apiResource('permissions',PermissionController::class);
        Route::get('/roles/{role}/permissions',[RoleController::class,'permissions']);
        Route::post('/roles/{role}/permissions',[RoleController::class,'updatePermissions']);
    
});