<?php

use App\Modules\Event\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
});
