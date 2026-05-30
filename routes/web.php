<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::post('login', [AuthController::class, 'login']);

Route::get('/dashboard', function () {

    return view('dashboard');
})->name('dashboard')->middleware('auth:web');

// Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/web-login', function () {
    return view('auth.login');
});

Route::post('/web-login', [AdminAuthController::class, 'webLogin'])

    ->name('web.login');
require __DIR__ . '/auth.php';
