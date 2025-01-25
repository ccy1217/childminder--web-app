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

    // Filters for cities and towns
    public $filter_city;
    public $filter_town;
    public $showFilters = true; // Controls whether filters are shown or hidden

    protected $paginationTheme = 'tailwind'; // Set the pagination theme (tailwind)

    public function mount()
    {
        // Retrieve filter values from the session if they exist
        $this->filter_city = session()->get('filter_city', null);
        $this->filter_town = session()->get('filter_town', null);
    }

    public function updated($propertyName)
    {
        // Save updated filter values to the session when changed
        if (str_starts_with($propertyName, 'filter_')) {
            session()->put($propertyName, $this->{$propertyName});
        }

        $this->resetPage(); // Reset pagination when filters are changed
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

        // Reset filters and pagination when going back to the list
        $this->filter_city = null;
        $this->filter_town = null;
        $this->showFilters = true; // Show filters again
        $this->resetPage(); // Reset pagination to the first page
    }

    public function searchProfiles()
    {
        // Hide the filters after searching
        $this->showFilters = false;

        // Reset pagination when the search is triggered
        $this->resetPage();
    }

    public function resetFilters()
    {
        // Reset the filter fields and show the filters again
        $this->filter_city = null;
        $this->filter_town = null;
        $this->showFilters = true;

        // Reset pagination when filters are reset
        $this->resetPage();
    }

    public function render()
    {
        $query = ChildminderProfile::query();

        // Apply filters if available
        if ($this->filter_city) {
            $query->where('city', $this->filter_city);
        }

        if ($this->filter_town) {
            $query->where('town', $this->filter_town);
        }

        // Paginate the filtered profiles
        $profiles = $query->latest()->paginate(10);

        // Get the first 10 cities and their corresponding towns
        $cities = ChildminderProfile::distinct()->pluck('city')->take(10);
        $towns = ChildminderProfile::distinct()->whereIn('city', $cities)->pluck('town', 'town')->take(10);

        return view('livewire.childminder-profile-show', [
            'profiles' => $profiles,
            'cities' => $cities,
            'towns' => $towns,
        ])->layout('layouts.app');
    }
}