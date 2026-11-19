<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/events', function () {
        return response()->json(['message' => 'Event Module berhasil dijalankan']);
    });
});
