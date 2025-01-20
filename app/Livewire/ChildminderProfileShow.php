<?php

namespace App\Livewire;

use App\Models\ChildminderProfile;
use Livewire\Component;

class ChildminderProfileShow extends Component
{
    public $profiles = [];
    public $profileId;
    public $currentProfile;
    public $viewMode = 'list'; // Controls the view mode (list or detail)

    public function mount()
    {
        // Load all profiles on component mount
        $this->profiles = ChildminderProfile::latest()->get();
    }

    public function showProfile($profileId)
    {
        // Find the profile with the given ID
        $this->profileId = $profileId;
        $this->currentProfile = ChildminderProfile::findOrFail($profileId);
        $this->viewMode = 'show'; // Switch to the detailed view
    }

    public function backToList()
    {
        // Go back to the list view
        $this->viewMode = 'list';
    }

    public function render()
    {
        return view('livewire.childminder-profile-show', [
            'profiles' => $this->profiles,
        ])->layout('layouts.app');
    }
}
