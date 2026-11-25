<?php

use App\Modules\Event\Http\Controllers\AdminEventController;
use App\Modules\Event\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    // Publik
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

    // Khusus Admin: CRUD event
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('events', AdminEventController::class)->except('show');
    });
});
