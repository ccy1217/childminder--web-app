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

    public function openMessageBoard(
        $sender_id, $client_id, $client_first_name, $client_last_name, 
        $childminder_id, $childminder_user_id, $childminder_first_name, $childminder_last_name, 
        $receiver_id, $sender_user_type, $receiver_user_type
    ) {
        return redirect()->route('message-board', [
            'sender_id' => $sender_id,
            'client_id' => $client_id,
            'client_first_name' => $client_first_name,
            'client_last_name' => $client_last_name,
            'childminder_id' => $childminder_id,
            'childminder_user_id' => $childminder_user_id,
            'childminder_first_name' => $childminder_first_name,
            'childminder_last_name' => $childminder_last_name,
            'receiver_id' => $receiver_id,
            'sender_user_type' => $sender_user_type,
            'receiver_user_type' => $receiver_user_type,
        ]);
    }
    
    



    // Render the component
    public function render()
    {
        return view('livewire.booking-actions')->layout('layouts.app');
    }
}


