<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\ChildminderProfileShow;
//use App\Http\Livewire\BookingActions;

//@livewire('booking-actions', ['booking' => $booking])

//Route::get('/booking/{booking}', BookingActions::class)->name('booking.actions');
// routes/web.php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware(['auth'])->group(function () {
    Route::get('/childminder-profile', ChildminderProfileShow::class)->name('childminder-profile-show');
});

