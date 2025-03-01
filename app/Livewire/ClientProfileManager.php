<?php

namespace App\Livewire;

use App\Models\ClientProfile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class ClientProfileManager extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $children_name;
    public $city;
    public $town;
    public $postcode;
    public $profile_picture;
    public $preferred_age_groups = [];
    public $age_group_options = [];
    public $specific_requirements;

    // Removed $my_document property
    // public $my_document = [];

    public $profile;

    public function mount()
    {
        $this->profile = Auth::user()->clientProfile;

        // Define age group options
        $this->age_group_options = [
            '0-2' => '0-2 years',
            '3-5' => '3-5 years',
            '6-12' => '6-12 years',
            '13-18' => '13-18 years',
        ];

        if ($this->profile) {
            $this->fill([
                'first_name' => $this->profile->first_name,
                'last_name' => $this->profile->last_name,
                'children_name' => $this->profile->children_name,
                'city' => $this->profile->city,
                'town' => $this->profile->town,
                'postcode' => $this->profile->postcode,
                'profile_picture' => $this->profile->profile_picture,
                'preferred_age_groups' => json_decode($this->profile->preferred_age_groups, true) ?? [],
                'specific_requirements' => $this->profile->specific_requirements,
                // Removed document fields
            ]);
        }
    }

    public function addAgeGroup()
    {
        $this->preferred_age_groups[] = null;
    }

    public function removeAgeGroup($index)
    {
        unset($this->preferred_age_groups[$index]);
        $this->preferred_age_groups = array_values($this->preferred_age_groups);
    }

    public function saveProfile()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'children_name' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'town' => 'nullable|string|max:255',
            'postcode' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'preferred_age_groups' => 'nullable|array',
            'preferred_age_groups.*' => 'nullable|string',
            'specific_requirements' => 'nullable|string',
            // Removed validation for my_document
        ]);

        // Save profile picture
        $profilePicturePath = $this->profile_picture
            ? $this->profile_picture->store('profile_pictures', 'public')
            : ($this->profile->profile_picture ?? null);

        // Prepare data
        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'children_name' => $this->children_name,
            'city' => $this->city,
            'town' => $this->town,
            'postcode' => $this->postcode,
            'profile_picture' => $profilePicturePath,
            'preferred_age_groups' => json_encode(array_values($this->preferred_age_groups), JSON_UNESCAPED_SLASHES),
            'specific_requirements' => $this->specific_requirements,
            // Removed documents field
        ];

        if ($this->profile) {
            $this->profile->update($data);
        } else {
            $profile = ClientProfile::create(array_merge($data, ['user_id' => Auth::id()]));
        }

        session()->flash('message', 'Profile saved successfully!');
    }

    public function render()
    {
        return view('livewire.client-profile-manager')->layout('layouts.app');
    }
}

