<?php

use App\Modules\Registration\Http\Controllers\AuthController;
use App\Modules\Registration\Http\Controllers\AdminRegistrationController;
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
        Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', fn() => view('registration::admin'))->name('home');

            Route::get('/registrations', [AdminRegistrationController::class, 'index'])->name('registrations');
            Route::post('/registrations/{registration}/confirm', [AdminRegistrationController::class, 'confirm'])
                ->name('registrations.confirm');
            Route::post('/registrations/{registration}/reject', [AdminRegistrationController::class, 'reject'])
                ->name('registrations.reject');

            Route::get('/check-in', [AdminRegistrationController::class, 'showCheckIn'])->name('check-in');
            Route::post('/check-in', [AdminRegistrationController::class, 'checkIn'])->name('check-in.store');
        });
    });
});
