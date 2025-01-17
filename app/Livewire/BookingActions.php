<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;

class BookingActions extends Component
{
    public $booking; // Bind the booking object
    public $status; // Track the current status

    protected $listeners = ['refreshComponent' => '$refresh']; // Allow other components to refresh this one

    public function mount(Booking $booking)
    {
        $this->booking = $booking;
        $this->status = $booking->status;
    }

    public function acceptBooking()
    {
        $this->booking->update(['status' => 'Confirmed']);
        $this->status = 'Confirmed';

        session()->flash('message', 'Booking has been accepted.');
        $this->emit('refreshComponent');
    }

    public function cancelBooking()
    {
        $this->booking->update(['status' => 'Cancelled']);
        $this->status = 'Cancelled';

        session()->flash('message', 'Booking has been cancelled.');
        $this->emit('refreshComponent');
    }

    public function render()
    {
        return view('livewire.booking-actions');
    }
}
