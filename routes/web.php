<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

Route::get('/login', function () {
    return view('auth.login');
})->name('web.login.form');

Route::post('/login', [AuthController::class, 'webLogin'])
    ->name('web.login');

Route::middleware('jwt.session')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // add all protected routes here
});