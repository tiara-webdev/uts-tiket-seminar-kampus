<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/registrations', function () {
        return response()->json(['message' => 'Registration Module berhasil dijalankan']);
    });
});
