<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Language;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingForm extends Component
{
    public $client_id;
    public $childminder_id;
    public $start_time;
    public $end_time;
    public $notes;
    public $childminder_name;
    public $selected_services = [];  // Store the selected services
    public $selected_languages = []; // Store the selected languages

    // Validation rules for the booking form
    protected $rules = [
        'childminder_id' => 'required|exists:childminder_profiles,id',
        'start_time' => 'required|date|after_or_equal:today',
        'end_time' => 'required|date|after:start_time',
        'notes' => 'nullable|string|max:500',
        'selected_services' => 'nullable|array', 
        'selected_services.*' => 'exists:services,id',
        'selected_languages' => 'nullable|array', // Validate selected languages
        'selected_languages.*' => 'exists:languages,id', // Validate each selected language ID
    ];

    public function mount($childminderId = null, $childminderName = null)
    {
        $this->childminder_id = $childminderId;
        $this->childminder_name = $childminderName;
    }

    public function submitBooking()
    {
        $this->validate();

        // Ensure the authenticated user has a client profile
        $client = Auth::user()->clientProfile;
        
        if (!$client) {
            session()->flash('error', 'You must have a client profile to book a childminder.');
            return;
        }

        // Assign client_id
        $this->client_id = $client->id;

        // Create the booking
        $booking = Booking::create([
            'client_id' => $this->client_id,
            'childminder_id' => $this->childminder_id,
            'start_time' => Carbon::parse($this->start_time),
            'end_time' => Carbon::parse($this->end_time),
            'notes' => $this->notes,
            'status' => 'Pending',
        ]);

        // Attach selected services and languages to the booking
        if ($this->selected_services) {
            $booking->services()->attach($this->selected_services);
        }

        if ($this->selected_languages) {
            $booking->languages()->attach($this->selected_languages); // Assuming `languages()` is defined in the `Booking` model
        }

        session()->flash('message', 'Booking created successfully!');
        $this->reset(['start_time', 'end_time', 'notes', 'selected_services', 'selected_languages']);
    }

    public function render()
    {
        $services = Service::all(); // Get all services for the checkboxes
        $languages = Language::all(); // Get all languages for the checkboxes

        return view('livewire.booking-form', [
            'childminder_name' => $this->childminder_name,
            'services' => $services, // Pass services to the view
            'languages' => $languages, // Pass languages to the view
        ])->layout('layouts.app');
    }
}
