<?php

<<<<<<< HEAD
use App\Http\Controllers\API\RoleController;
=======
>>>>>>> 4a09523850cfeebdfa692b54279caaa0c7c1689b
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::apiResource('users', UserController::class);
<<<<<<< HEAD
    Route::apiResource('roles', RoleController::class);
});

Route::middleware('auth:api')->get('/test-user', function (Request $request) {
    return auth()->user();
=======
>>>>>>> 4a09523850cfeebdfa692b54279caaa0c7c1689b
});

