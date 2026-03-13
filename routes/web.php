<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $stats = [
        'total_vehicles' => \App\Models\Vehicle::count(),
        'active_bookings' => \App\Models\Booking::whereIn('status', ['pending', 'approved'])->count(),
        'total_drivers' => \App\Models\Driver::count(),
    ];
    return view('welcome', compact('stats'));
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('bookings', App\Http\Controllers\BookingController::class);
    Route::post('/bookings/{id}/in-progress', [App\Http\Controllers\BookingController::class, 'markAsInProgress'])->name('bookings.inProgress');
    Route::post('/bookings/{id}/complete', [App\Http\Controllers\BookingController::class, 'markAsCompleted'])->name('bookings.complete');
    
    Route::post('/approvals/{id}/approve', [App\Http\Controllers\ApprovalController::class, 'approve'])->name('approvals.approve');
    Route::post('/approvals/{id}/reject', [App\Http\Controllers\ApprovalController::class, 'reject'])->name('approvals.reject');

    // Report Routes
    Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [App\Http\Controllers\ReportController::class, 'export'])->name('reports.export');

    // Admin Routes
    Route::middleware(['can:is-admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('vehicles', \App\Http\Controllers\Admin\VehicleController::class);
        Route::resource('drivers', \App\Http\Controllers\Admin\DriverController::class);
        Route::resource('locations', \App\Http\Controllers\Admin\LocationController::class);
        Route::resource('usages', \App\Http\Controllers\Admin\UsageLogController::class)->except(['destroy', 'show']);
        Route::resource('services', \App\Http\Controllers\Admin\ServiceLogController::class)->except(['destroy', 'show']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
