<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ChildminderNotificationBoard extends Component
{
    public $bookings; // Store the bookings to be displayed

    // Load the bookings for the authenticated childminder
    public function mount()
    {
        $this->loadBookings();
    }

    // Load the bookings
    public function loadBookings()
    {
        if (Auth::check() && Auth::user()->childminderProfile) {
            $childminderProfile = Auth::user()->childminderProfile;
            $this->bookings = Booking::where('childminder_id', $childminderProfile->id)
                                     ->where('status', 'Pending')
                                     ->with('clientprofile') // Eager load the clientprofile
                                     ->get();
        } else {
            $this->bookings = collect();
        }
    }

    // Accept a booking (change status to 'Confirmed')
    public function acceptBooking($bookingId)
    {
        $booking = Booking::find($bookingId);

        if ($booking && $booking->childminder_id == Auth::user()->childminderProfile->id && $booking->status == 'Pending') {
            $booking->status = 'Confirmed';
            $booking->save();

            session()->flash('message', 'Booking accepted successfully!');
            $this->loadBookings();  // Reload the bookings to reflect changes
        }
    }

    // Reject a booking (change status to 'Cancelled')
    public function rejectBooking($bookingId)
    {
        $booking = Booking::find($bookingId);

        if ($booking && $booking->childminder_id == Auth::user()->childminderProfile->id && $booking->status == 'Pending') {
            $booking->status = 'Cancelled';
            $booking->save();

            session()->flash('message', 'Booking rejected successfully!');
            $this->loadBookings();  // Reload the bookings to reflect changes
        }
    }

    // Render the component
    public function render()
    {
        return view('livewire.childminder-notification-board')->layout('layouts.app');
    }
}
