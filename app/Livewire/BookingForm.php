<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\ClientProfile;
use App\Models\ChildminderProfile;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingForm extends Component
{
    public $client_id;
    public $childminder_id;
    public $start_time;
    public $end_time;
    public $notes;
    public $childminder_name;

    // Validation rules for the booking form
    protected $rules = [
        'childminder_id' => 'required|exists:childminder_profiles,id',
        'start_time' => 'required|date|after_or_equal:today',
        'end_time' => 'required|date|after:start_time',
        'notes' => 'nullable|string|max:500',
    ];

    public function mount($childminderId = null, $childminderName = null)
{
    $this->childminder_id = $childminderId;
    $this->childminder_name = $childminderName;
}


    public function submitBooking()
    {
        // Validate the form data
        $this->validate();

        // Create a new booking with 'Pending' status by default
        Booking::create([
            'client_id' => $this->client_id,
            'childminder_id' => $this->childminder_id,
            'start_time' => Carbon::parse($this->start_time),
            'end_time' => Carbon::parse($this->end_time),
            'notes' => $this->notes,
            'status' => 'Pending', // Status is always set to 'Pending'
        ]);

        // Flash success message
        session()->flash('message', 'Booking created successfully!');

        // Reset the form fields after submission
        $this->reset(['start_time', 'end_time', 'notes']);

        // Emit an event for further actions
        $this->emit('bookingCreated');
    }

    public function render()
    {
        return view('livewire.booking-form', [
            'childminder_name' => $this->childminder_name,
        ])->layout('layouts.app');
    }
}
