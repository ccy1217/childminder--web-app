<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BookingActions extends Component
{
    public $bookings; // Store the bookings to be displayed

    // Load the bookings for the authenticated client
    public function mount()
    {
        $this->loadBookings();
    }

    // Load the bookings for the authenticated client
    // In your BookingActions.php Livewire Component

public function loadBookings()
{
    if (Auth::check()) {
        $this->bookings = Booking::where('client_id', Auth::user()->clientprofile->id)
                                 ->with('childminderprofile') // Eager load childminder profile
                                 ->get();
    } else {
        $this->bookings = collect();
    }
}


    // Render the component
    public function render()
    {
        return view('livewire.booking-actions')->layout('layouts.app');
    }
}


