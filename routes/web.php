<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\ChildminderProfileShow;
use App\Livewire\ChildminderProfileManager;
use App\Livewire\ChildminderProfileShowInClient;
use App\Livewire\ClientProfileManager;
use App\Livewire\BookingForm;
use App\Models\ClientProfile;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/map', function () {
//     return response()->file(resource_path('views/maps/map.html'));
// });


// use App\Models\Service;

// Route::get('/dashboard', function () {
//     $services = Service::all(); // Retrieve all services
//     return view('dashboard', compact('services'));
// })->middleware(['auth', 'verified'])->name('dashboard');



// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Profile Edit Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Childminder Profile Routes
    Route::get('/childminder-profile', ChildminderProfileShow::class)->name('childminder-profile-show');
    Route::get('/childminder-profile/childminder-manage', ChildminderProfileManager::class)->name('childminder-profile-manage');

     // Client Profile  Route
    Route::get('/childminder-profiles', ChildminderProfileShowInClient::class)
    ->name('childminder-profile-show-in-client');

    Route::get('/map/{childminderId}/{childminderName}/{childminderPostcode}', function ($childminderId, $childminderName, $childminderPostcode) {
        $client = ClientProfile::where('user_id', Auth::id())->first(); // Get current client's profile
        
        $clientPostcode = $client ? $client->postcode : null; // Handle cases where client might not have a postcode
    
        return view('maps.map', compact('childminderId', 'childminderName', 'childminderPostcode', 'clientPostcode'));
    })->middleware('auth')->name('map.with-params');

    // Beacuse i wanna pass the childminderID and childminderName from 'childminder-profile' at the same time so i need the to include in the path for passing the data
    Route::get('/childminder-profiles/{childminderId}/{childminderName}', BookingForm::class)
    ->name('booking-form');
    Route::get('/childminder-profiles/client-manage', ClientProfileManager::class)->name('client-profile-manager');


});

require __DIR__.'/auth.php';
