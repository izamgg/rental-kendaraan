<?php

use Illuminate\Support\Facades\Route;
use App\Models\Vehicle;
use App\Models\Rental;

// Pastikan mengembalikan collections/array langsung tanpa response()->json()
Route::get('/vehicles', function () {
    return Vehicle::latest()->get(); 
});

Route::get('/rentals', function () {
    return Rental::with(['user', 'vehicle'])->get();
});