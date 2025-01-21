<?php

namespace App\Livewire;

use App\Models\ChildminderProfile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public $geographical_area;
    public $experience_years;
    public $age_group_fields = [];
    public $my_document = [];
    public $profile_picture;

    // Define service options
    public $serviceOptions = [
        'childcare_services' => 'Childcare Services',
        'special_care' => 'Special Care',
        'meal_preparation' => 'Meal Preparation',
        'transportation' => 'Transportation (pick-up and drop-off services)',
        'educational_support' => 'Educational and developmental support',
        'sleep_support' => 'Sleep and routine support',
    ];

    // Dynamically handled service scope
    public $service_scope = []; // This holds the selected options

    public $profile;

    public function mount()
    {
        $this->profile = Auth::user()->childminderProfile;

        if ($this->profile) {
            $this->fill([
                'first_name' => $this->profile->first_name,
                'last_name' => $this->profile->last_name,
                'city' => $this->profile->city,
                'town' => $this->profile->town,
                'hourly_rate' => $this->profile->hourly_rate,
                'about_me' => $this->profile->about_me,
                'postcode' => $this->profile->postcode,
                'geographical_area' => $this->profile->geographical_area,
                'experience_years' => $this->profile->experience_years,
                'age_group_fields' => json_decode($this->profile->age_groups, true) ?? [],
                'my_document' => json_decode($this->profile->my_document, true) ?? [],
                'profile_picture' => $this->profile->profile_picture,
                'service_scope' => json_decode($this->profile->service_scope_description, true) ?? [],
            ]);
        }
    }

    public function addAgeGroupField()
    {
        $this->age_group_fields[] = null;
    }

    public function removeAgeGroupField($index)
    {
        unset($this->age_group_fields[$index]);
        $this->age_group_fields = array_values($this->age_group_fields);
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
            'geographical_area' => 'nullable|string',
            'experience_years' => 'nullable|integer',
            'age_group_fields' => 'nullable|array',
            'age_group_fields.*' => 'nullable|string',
            'my_document.*' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'service_scope' => 'array',
        ]);

        // Convert selected service scope options to an associative array
        $serviceScope = [];
        foreach ($this->service_scope as $service) {
            $serviceScope[$service] = true;
        }

        // Profile Picture Handling
        $profilePicturePath = $this->profile_picture 
            ? $this->profile_picture->store('profile_pictures', 'public') 
            : ($this->profile->profile_picture ?? null);

        // Document Uploads
        $uploadedDocuments = [];
        if ($this->my_document) {
            foreach ($this->my_document as $document) {
                $uploadedDocuments[] = $document->store('documents', 'public');
            }
        }

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'city' => $this->city,
            'town' => $this->town,
            'hourly_rate' => $this->hourly_rate,
            'about_me' => $this->about_me,
            'postcode' => $this->postcode,
            'geographical_area' => $this->geographical_area,
            'experience_years' => $this->experience_years,
            'age_groups' => json_encode($this->age_group_fields),
            'my_document' => json_encode($uploadedDocuments),
            'profile_picture' => $profilePicturePath,
            'service_scope_description' => json_encode($serviceScope),
        ];

        if ($this->profile) {
            $this->profile->update($data);
        } else {
            ChildminderProfile::create(array_merge($data, ['user_id' => Auth::id()]));
        }

        session()->flash('message', 'Profile saved successfully!');
    }

    public function render()
{
    return view('livewire.childminder-profile-manager', [
        'service_scope_options' => $this->serviceOptions,
    ])->layout('layouts.app');
}

}
