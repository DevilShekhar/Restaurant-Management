<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('/profile', [AuthController::class,'profile']);

    Route::post('/logout',[AuthController::class,'logout']);

    Route::middleware('role:super_admin')
        ->group(function () {

            Route::apiResource('users',UserController::class
            );
        });
});