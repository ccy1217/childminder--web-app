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

    // Filters for cities, towns, services, and languages
    public $filter_city;
    public $filter_town;
    public $filter_service;
    public $filter_language;
    public $showFilters = true;

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->filter_city = session()->get('filter_city', null);
        $this->filter_town = session()->get('filter_town', null);
        $this->filter_service = session()->get('filter_service', null);
        $this->filter_language = session()->get('filter_language', null);
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
        $this->viewMode = 'list';
    }

    public function searchProfiles()
    {
        $this->showFilters = false;
        $this->resetPage();
    }

    public function render()
    {
        $query = ChildminderProfile::query();

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

        $profiles = $query->latest()->paginate(10);

        $cities = ChildminderProfile::distinct()->pluck('city')->take(10);
        $towns = ChildminderProfile::distinct()->whereIn('city', $cities)->pluck('town', 'town')->take(10);
        $services = Service::pluck('name', 'id');
        $languages = Language::pluck('name', 'id');

        return view('livewire.childminder-profile-show', [
            'profiles' => $profiles,
            'cities' => $cities,
            'towns' => $towns,
            'services' => $services,
            'languages' => $languages,
        ])->layout('layouts.app');
    }
}
