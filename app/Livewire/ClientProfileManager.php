<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClientProfile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;


class ClientProfileManager extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $children_name;
    public $profile_picture;
    public $city;
    public $town;
    public $postcode;
    public $preferred_age_groups = [];
    public $specific_requirements;
    public $existingProfile;
    public $newProfilePicture;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'children_name' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'town' => 'nullable|string|max:255',
        'postcode' => 'nullable|string|max:20',
        'preferred_age_groups' => 'array',
        'specific_requirements' => 'nullable|string',
        'newProfilePicture' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $this->existingProfile = ClientProfile::where('user_id', Auth::id())->first();

        if ($this->existingProfile) {
            $this->first_name = $this->existingProfile->first_name;
            $this->last_name = $this->existingProfile->last_name;
            $this->children_name = $this->existingProfile->children_name;
            $this->profile_picture = $this->existingProfile->profile_picture;
            $this->city = $this->existingProfile->city;
            $this->town = $this->existingProfile->town;
            $this->postcode = $this->existingProfile->postcode;
            $this->preferred_age_groups = json_decode($this->existingProfile->preferred_age_groups, true) ?? [];
            $this->specific_requirements = $this->existingProfile->specific_requirements;
        }
    }

    public function saveProfile()
    {
        $this->validate();

        if ($this->newProfilePicture) {
            $profilePicturePath = $this->newProfilePicture->store('profile_pictures', 'public');
        } else {
            $profilePicturePath = $this->profile_picture;
        }

        ClientProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'children_name' => $this->children_name,
                'profile_picture' => $profilePicturePath,
                'city' => $this->city,
                'town' => $this->town,
                'postcode' => $this->postcode,
                'preferred_age_groups' => json_encode($this->preferred_age_groups),
                'specific_requirements' => $this->specific_requirements,
            ]
        );

        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.client-profile-manager');
    }
}