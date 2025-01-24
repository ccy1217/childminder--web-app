<?php

namespace App\Livewire;

use App\Models\ChildminderProfile;
use App\Models\Service;
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
    public $geographical_area;
    public $experience_years;
    public $age_group_fields = [];
    public $my_document = [];
    public $profile_picture;

    public $serviceOptions = [];
    public $service_scope = []; // Holds selected service IDs

    public $profile;

    public function mount()
    {
        $this->profile = Auth::user()->childminderProfile;

        // Load all available service options
        $this->serviceOptions = Service::pluck('name', 'id')->toArray();

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
                'service_scope' => $this->profile->services->pluck('id')->toArray(), // Load associated services
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

        // Save profile picture if uploaded
        $profilePicturePath = $this->profile_picture 
            ? $this->profile_picture->store('profile_pictures', 'public') 
            : ($this->profile->profile_picture ?? null);

        // Save documents if uploaded
        $uploadedDocuments = [];
        if ($this->my_document) {
            foreach ($this->my_document as $document) {
                $uploadedDocuments[] = $document->store('documents', 'public');
            }
        }

        // Prepare the profile data
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
        ];

        if ($this->profile) {
            $this->profile->update($data);
            // Sync selected services to the pivot table
            $this->profile->services()->sync($this->service_scope);
        } else {
            $profile = ChildminderProfile::create(array_merge($data, ['user_id' => Auth::id()]));
            // Sync selected services to the pivot table
            $profile->services()->sync($this->service_scope);
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
