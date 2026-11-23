<?php

use App\Modules\Registration\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    // Hanya untuk tamu (belum login)
    Route::middleware('guest')->group(function () {
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Harus login
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', fn() => view('registration::dashboard'))->name('dashboard');

        // Khusus Admin
        Route::middleware('role:admin')->group(function () {
            Route::get('/admin', fn() => view('registration::admin'))->name('admin.home');
        });
    });
});
