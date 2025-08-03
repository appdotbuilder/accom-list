<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\Admin\AccommodationController as AdminAccommodationController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\Admin\RoomTypeController as AdminRoomTypeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Home page - main functionality
Route::get('/', [AccommodationController::class, 'index'])->name('home');

// Public accommodation routes
Route::controller(AccommodationController::class)->group(function () {
    Route::get('/accommodations', 'index')->name('accommodations.index');
    Route::get('/accommodations/{accommodation}', 'show')->name('accommodations.show');
});

// Admin routes (requires authentication)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Accommodations management
    Route::resource('accommodations', AdminAccommodationController::class);
    
    // Room types management (nested under accommodations)
    Route::resource('accommodations.room-types', AdminRoomTypeController::class)
        ->except(['show']);
    
    // Facilities management
    Route::resource('facilities', AdminFacilityController::class)
        ->except(['show']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
