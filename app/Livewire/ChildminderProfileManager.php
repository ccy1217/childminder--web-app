<?php
namespace App\Livewire;

use App\Models\ChildminderProfile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class ChildminderProfileManager extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $city;
    public $town;
    public $hourly_rate;
    public $about_me;
    public $postcode;
    public $service_scope_description;
    public $geographical_area;
    public $experience_years;
    public $age_groups = [];  // This will hold the selected age groups
    public $my_document = [];

    public $profile;

    public function mount()
    {
        $this->profile = Auth::user()->childminderProfile;

        if ($this->profile) {
            $this->first_name = $this->profile->first_name;
            $this->last_name = $this->profile->last_name;
            $this->city = $this->profile->city;
            $this->town = $this->profile->town;
            $this->hourly_rate = $this->profile->hourly_rate;
            $this->about_me = $this->profile->about_me;
            $this->postcode = $this->profile->postcode;
            $this->service_scope_description = $this->profile->service_scope_description;
            $this->geographical_area = $this->profile->geographical_area;
            $this->experience_years = $this->profile->experience_years;
            $this->age_groups = json_decode($this->profile->age_groups, true) ?? [];
            $this->my_document = json_decode($this->profile->my_document, true) ?? [];
        }
    }

    public function saveProfile()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'town' => 'nullable|string|max:255',
            'hourly_rate' => 'required|numeric',
            'about_me' => 'nullable|string',
            'postcode' => 'nullable|string',
            'service_scope_description' => 'nullable|string',
            'geographical_area' => 'nullable|string',
            'experience_years' => 'nullable|integer',
            'age_groups' => 'nullable|array',
            'my_document' => 'nullable|array',
        ]);

        // Handle file uploads
        if ($this->my_document) {
            $uploadedFiles = [];
            foreach ($this->my_document as $document) {
                $uploadedFiles[] = $document->store('storage/app/private/documents');
            }
            $this->my_document = $uploadedFiles;
        }

        // Save or update the profile
        if ($this->profile) {
            $this->profile->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'city' => $this->city,
                'town' => $this->town,
                'hourly_rate' => $this->hourly_rate,
                'about_me' => $this->about_me,
                'postcode' => $this->postcode,
                'service_scope_description' => $this->service_scope_description,
                'geographical_area' => $this->geographical_area,
                'experience_years' => $this->experience_years,
                'age_groups' => json_encode($this->age_groups),  // Encode the array into JSON
                'my_document' => json_encode($this->my_document),
            ]);
        } else {
            ChildminderProfile::create([
                'user_id' => Auth::id(),
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'city' => $this->city,
                'town' => $this->town,
                'hourly_rate' => $this->hourly_rate,
                'about_me' => $this->about_me,
                'postcode' => $this->postcode,
                'service_scope_description' => $this->service_scope_description,
                'geographical_area' => $this->geographical_area,
                'experience_years' => $this->experience_years,
                'age_groups' => json_encode($this->age_groups),
                'my_document' => json_encode($this->my_document),
            ]);
        }

        session()->flash('message', 'Profile saved successfully!');
    }

    public function render()
    {
        return view('livewire.childminder-profile-manager')->layout('layouts.app');
    }
}
