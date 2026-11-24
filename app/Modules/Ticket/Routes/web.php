<?php

use App\Modules\Ticket\Http\Controllers\AdminTicketTypeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/events/{eventId}/tickets', [AdminTicketTypeController::class, 'index'])
        ->whereNumber('eventId')
        ->name('events.tickets');
    Route::post('/events/{eventId}/tickets', [AdminTicketTypeController::class, 'store'])
        ->whereNumber('eventId')
        ->name('events.tickets.store');
    Route::delete('/tickets/{ticketType}', [AdminTicketTypeController::class, 'destroy'])
        ->name('tickets.destroy');
});
