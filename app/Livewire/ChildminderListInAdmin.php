<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChildminderProfile;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ChildminderListInAdmin extends Component
{
    use WithPagination;

    public $profileId;
    public $currentProfile;
    public $viewMode = 'list';
    public $searchTerm = '';

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        // No need to handle filters for this use case anymore
    }

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function showProfile($profileId)
    {
        $this->profileId = $profileId;
        $this->currentProfile = ChildminderProfile::findOrFail($profileId);
        $this->viewMode = 'show';
    }

    public function backToList()
    {
        $this->searchTerm = '';  // Reset search term
        $this->viewMode = 'list';  // Switch back to list view
    }

    public function deleteProfile($profileId)
    {
        // Check if profile exists and delete it
        $profile = ChildminderProfile::findOrFail($profileId);
        $profile->delete();

        // After deletion, go back to list view
        session()->flash('message', 'Profile deleted successfully!');
        $this->backToList();
    }

    public function searchProfiles()
    {
        $this->resetPage(); // Reset pagination when a new search is performed

        // Filter the profiles by ID or name
        $this->render(); // Re-render the profiles after the search is executed
    }

    public function render()
    {
        $query = ChildminderProfile::query();

        // Apply search term filtering - only search by ID or name
        if ($this->searchTerm) {
            $query->where(function($query) {
                $query->where('id', 'like', '%' . $this->searchTerm . '%')  // Search by childminder ID
                      ->orWhere('first_name', 'like', '%' . $this->searchTerm . '%')  // Search by first name
                      ->orWhere('last_name', 'like', '%' . $this->searchTerm . '%');  // Search by last name
            });
        }

        // Paginate the filtered results
        $profiles = $query->latest()->paginate(10);

        return view('livewire.childminder-list-in-admin', [
            'profiles' => $profiles,
        ])->layout('layouts.app');
    }
}
