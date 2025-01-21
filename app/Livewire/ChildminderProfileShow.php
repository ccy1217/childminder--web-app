<?php
namespace App\Livewire;

use App\Models\ChildminderProfile;
use Livewire\Component;
use Livewire\WithPagination;

class ChildminderProfileShow extends Component
{
    use WithPagination; // Import the pagination trait

    public $profileId;
    public $currentProfile;
    public $viewMode = 'list'; // Controls the view mode (list or detail)

    protected $paginationTheme = 'tailwind'; // Set the pagination theme (bootstrap or tailwind)

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
            'profiles' => ChildminderProfile::latest()->paginate(10), // Paginate with 10 profiles per page
        ])->layout('layouts.app');
    }
}
