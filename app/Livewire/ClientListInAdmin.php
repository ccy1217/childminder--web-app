<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClientProfile; // Use the ClientProfile model
use Livewire\WithPagination;

class ClientListInAdmin extends Component
{
    use WithPagination;

    public $profileId;
    public $currentProfile;
    public $viewMode = 'list';
    public $searchTerm = '';

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        // Any initialization if necessary
    }

    public function updated($propertyName)
    {
        $this->resetPage(); // Reset pagination on property update
    }

    public function showProfile($profileId)
    {
        $this->profileId = $profileId;
        $this->currentProfile = ClientProfile::findOrFail($profileId); // Get the client profile
        $this->viewMode = 'show'; // Switch to show mode
    }

    public function backToList()
    {
        $this->searchTerm = '';  // Clear search term
        $this->viewMode = 'list';  // Switch back to list view
    }

    public function deleteProfile($profileId)
    {
        // Delete the profile after checking it exists
        $profile = ClientProfile::findOrFail($profileId);
        $profile->delete();

        session()->flash('message', 'Profile deleted successfully!');
        $this->backToList(); // Return to list view
    }

    // Search method is simplified - no need to call render() explicitly
    public function searchProfiles()
    {
        $this->resetPage(); // Reset pagination when a new search is performed
    }

    public function render()
    {
        $query = ClientProfile::query();

        // Apply search filtering based on the search term
        if ($this->searchTerm) {
            $query->where(function($query) {
                $query->where('id', 'like', '%' . $this->searchTerm . '%')  // Search by client profile ID
                      ->orWhere('first_name', 'like', '%' . $this->searchTerm . '%')  // Search by first name
                      ->orWhere('last_name', 'like', '%' . $this->searchTerm . '%')   // Search by last name
                      ->orWhere('children_name', 'like', '%' . $this->searchTerm . '%');  // Search by child's name
            });
        }

        // Paginate results
        $profiles = $query->latest()->paginate(10);

        return view('livewire.client-list-in-admin', [
            'profiles' => $profiles,
        ])->layout('layouts.app');
    }
}
