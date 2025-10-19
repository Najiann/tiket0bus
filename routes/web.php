<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Models\Booking;

Route::get('/', function () {
    $buses = \App\Models\Bus::all();
    $bookings = Auth::check()
        ? \App\Models\Booking::with(['bus', 'destination'])->where('user_id', Auth::id())->get()
        : collect();
    return view('bookings.index', compact('buses', 'bookings'));
});

Route::resource('buses', BusController::class);
Route::resource('destinations', DestinationController::class);
Route::resource('bookings', BookingController::class)->middleware('auth');
Route::get('/mybookings', [BookingController::class, 'myBookings'])->name('bookings.mybookings')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
