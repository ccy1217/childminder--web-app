<?php

namespace App\Livewire;

use App\Models\ChildminderProfile;
use App\Models\Service;
use App\Models\Language;
use Livewire\Component;
use Livewire\WithPagination;

class ChildminderProfileShow extends Component
{
    use WithPagination;

    public $profileId;
    public $currentProfile;
    public $viewMode = 'list';

    // Filters for cities, towns, services, languages, and age group
    public $filter_city;
    public $filter_town;
    public $filter_service;
    public $filter_language;
    public $filter_age_group;
    public $showFilters = true;

    // Search term
    public $searchTerm = '';

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->filter_city = session()->get('filter_city', null);
        $this->filter_town = session()->get('filter_town', null);
        $this->filter_service = session()->get('filter_service', null);
        $this->filter_language = session()->get('filter_language', null);
        $this->filter_age_group = session()->get('filter_age_group', null); // Initialize age group filter
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'filter_')) {
            session()->put($propertyName, $this->{$propertyName});
        }
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
    $this->resetFilters();  // Clear filters
    $this->searchTerm = '';  // Reset search term
    $this->viewMode = 'list';  // Switch back to list view
}

    public function searchProfiles()
    {
        $this->showFilters = false;  // Hide filters after search
        $this->resetPage();  // Reset pagination so we can fetch fresh data
    }

    public function resetFilters()
    {
        $this->filter_city = null;
        $this->filter_town = null;
        $this->filter_service = null;
        $this->filter_language = null;
        $this->filter_age_group = null;
        $this->showFilters = true;  // Show the filters when reset
        $this->resetPage();  // Reset pagination
    }

    public function render()
    {
        $query = ChildminderProfile::query();

        // Apply filters
        if ($this->filter_city) {
            $query->where('city', $this->filter_city);
        }

        if ($this->filter_town) {
            $query->where('town', $this->filter_town);
        }

        if ($this->filter_service) {
            $query->whereHas('services', function ($q) {
                $q->where('services.id', $this->filter_service);
            });
        }

        if ($this->filter_language) {
            $query->whereHas('languages', function ($q) {
                $q->where('languages.id', $this->filter_language);
            });
        }

        // Filter by age group
        if ($this->filter_age_group) {
            $query->whereJsonContains('age_groups', $this->filter_age_group);
        }

        // Add search term filtering
        if ($this->searchTerm) {
            $query->where(function($query) {
                $query->where('first_name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('last_name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('postcode', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('city', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('town', 'like', '%' . $this->searchTerm . '%')
                      ->orWhereHas('services', function ($q) {
                          $q->where('name', 'like', '%' . $this->searchTerm . '%');
                      });
            });
        }

        // Paginate the filtered results
        $profiles = $query->latest()->paginate(10);

        // Prepare filter options
        $cities = ChildminderProfile::distinct()->pluck('city')->take(10);
        $towns = ChildminderProfile::distinct()->whereIn('city', $cities)->pluck('town', 'town')->take(10);
        $services = Service::pluck('name', 'id');
        $languages = Language::pluck('name', 'id');
        $ageGroups = ['0-2', '3-5', '6-12', '13-18'];  // Age group options

        return view('livewire.childminder-profile-show', [
            'profiles' => $profiles,
            'cities' => $cities,
            'towns' => $towns,
            'services' => $services,
            'languages' => $languages,
            'ageGroups' => $ageGroups, 
        ])->layout('layouts.app');
    }
}

