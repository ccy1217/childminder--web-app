<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class BookingActions extends Component
{
    public $bookings; // Store the bookings to be displayed
    public $unreadMessageUserIds = [];


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
                                     ->with('childminderprofile')
                                     ->get();
    
            // Gather all childminder user IDs
            $childminderUserIds = $this->bookings->pluck('childminderprofile.user_id')->filter()->unique();
    
            // Fetch IDs that have unread messages
            $this->unreadMessageUserIds = Message::whereIn('sender_id', $childminderUserIds)
                ->where('receiver_id', Auth::id())
                ->where('is_read', false)
                ->pluck('sender_id')
                ->toArray();
        } else {
            $this->bookings = collect();
            $this->unreadMessageUserIds = [];
        }
    }
    

    public function hasUnreadMessages($childminder_user_id)
    {
        return Message::where('sender_id', $childminder_user_id)
                    ->where('receiver_id', Auth::id())
                    ->where('is_read', false)
                    ->exists();
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


