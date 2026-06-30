<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// =====================
// DASHBOARD
// =====================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// =====================
// AUTH AREA
// =====================
Route::middleware('auth')->group(function () {

    // =====================
    // PROFILE
    // =====================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // =====================
    // VEHICLES (ADMIN ONLY)
    // =====================
    Route::resource('vehicles', VehicleController::class)
        ->middleware('role:admin');


    // =====================
    // USER RENTAL
    // =====================
    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');
    Route::post('/rent', [RentalController::class, 'store'])->name('rental.store');
    Route::get('/my-rental', [RentalController::class, 'history'])->name('rental.history');

    // AJAX
    Route::get('/calculate/{id}/{days}', [RentalController::class, 'calculate'])
        ->name('rental.calculate');


    // =====================
    // ADMIN RENTAL
    // =====================
    Route::middleware('role:admin')->group(function () {

        Route::get('/admin/rental', [RentalController::class, 'admin'])
            ->name('admin.rental');

        Route::post('/rental/{id}/approve', [RentalController::class, 'approve'])
            ->name('rental.approve');

        Route::post('/rental/{id}/reject', [RentalController::class, 'reject'])
            ->name('rental.reject');
    });

});

require __DIR__.'/auth.php';