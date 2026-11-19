<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/tickets', function () {
        return response()->json(['message' => 'Ticket Module berhasil dijalankan']);
    });
});
