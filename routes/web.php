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
use App\Livewire\MessageBoard;

Route::get('/', function () {
   return view('welcome');
});

Route::get('/search', function () {
    return view('search');
});
Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Authenticated User Routes
Route::middleware('auth')->group(function () {

    //Admin
    Route::get('/admin/manage-clients', [UserManagementController::class, 'manageClients'])->name('admin.manage-clients');
    Route::get('/admin/manage-childminders', [UserManagementController::class, 'manageChildminders'])->name('admin.manage-childminders');

    Route::get('dashboard/message-board/{sender_id}/{client_id}/{client_first_name}/{client_last_name}/{childminder_id}/{childminder_user_id}/{childminder_first_name}/{childminder_last_name}/{receiver_id}/{sender_user_type}/{receiver_user_type}', 
    MessageBoard::class)->name('message-board');

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

    //Showing distance and travelling time between current account's client and childminder
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
