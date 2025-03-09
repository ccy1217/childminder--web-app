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
                                     ->whereIn('status', ['Pending', 'Confirmed', 'Cancelled']) // Fetch all statuses
                                     ->with('clientprofile') // Eager load the client profile
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

    public function openMessageBoard(
        $sender_id, $client_id, $client_first_name, $client_last_name, 
        $childminder_id, $childminder_user_id, $childminder_first_name, $childminder_last_name, 
        $receiver_id
    ) {
        // Determine user types based on IDs
        $sender_user_type = ($sender_id == $client_id) ? 'client' : 'childminder';
        $receiver_user_type = ($receiver_id == $client_id) ? 'client' : 'childminder';
    
        return redirect()->route('message-board', [
            'sender_id' => $sender_id,
            'sender_user_type' => $sender_user_type,
            'client_id' => $client_id,
            'client_first_name' => $client_first_name,
            'client_last_name' => $client_last_name,
            'childminder_id' => $childminder_id,
            'childminder_user_id' => $childminder_user_id,
            'childminder_first_name' => $childminder_first_name,
            'childminder_last_name' => $childminder_last_name,
            'receiver_id' => $receiver_id,
            'receiver_user_type' => $receiver_user_type,
        ]);
    }
    
    // Render the component with different statuses
    public function render()
    {
        return view('livewire.childminder-notification-board', [
            'pendingBookings' => $this->bookings->where('status', 'Pending'),
            'confirmedBookings' => $this->bookings->where('status', 'Confirmed'),
            'cancelledBookings' => $this->bookings->where('status', 'Cancelled'),
        ])->layout('layouts.app');
    }
}

