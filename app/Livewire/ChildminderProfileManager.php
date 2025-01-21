<?php
namespace App\Livewire;

use App\Models\ChildminderProfile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public $service_scope_description;
    public $geographical_area;
    public $experience_years;
    public $age_groups = [];
    public $my_document = [];
    public $profile_picture;

    public $profile;

    public function mount()
    {
        $this->profile = Auth::user()->childminderProfile;

        if ($this->profile) {
            $this->fill([
                'first_name' => $this->profile->first_name,
                'last_name' => $this->profile->last_name,
                'city' => $this->profile->city,
                'town' => $this->profile->town,
                'hourly_rate' => $this->profile->hourly_rate,
                'about_me' => $this->profile->about_me,
                'postcode' => $this->profile->postcode,
                'service_scope_description' => $this->profile->service_scope_description,
                'geographical_area' => $this->profile->geographical_area,
                'experience_years' => $this->profile->experience_years,
                'age_groups' => json_decode($this->profile->age_groups, true) ?? [],
                'my_document' => json_decode($this->profile->my_document, true) ?? [],
                'profile_picture' => $this->profile->profile_picture,
            ]);
        }
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
            'service_scope_description' => 'nullable|string',
            'geographical_area' => 'nullable|string',
            'experience_years' => 'nullable|integer',
            'age_groups' => 'nullable|array',
            'my_document.*' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handling Profile Picture Upload
        if ($this->profile_picture) {
            // Delete old profile picture from storage if it exists
            if ($this->profile && $this->profile->profile_picture) {
                Storage::disk('public')->delete($this->profile->profile_picture);
            }
            $profilePicturePath = $this->profile_picture->store('profile_pictures', 'public');
        } else {
            // Fallback to existing profile picture
            $profilePicturePath = $this->profile ? $this->profile->profile_picture : null;
        }

        // Handling Document Uploads
        $uploadedDocuments = [];
        if ($this->my_document) {
            foreach ($this->my_document as $document) {
                $uploadedDocuments[] = $document->store('documents', 'public');
            }
        }

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'city' => $this->city,
            'town' => $this->town,
            'hourly_rate' => $this->hourly_rate,
            'about_me' => $this->about_me,
            'postcode' => $this->postcode,
            'service_scope_description' => $this->service_scope_description,
            'geographical_area' => $this->geographical_area,
            'experience_years' => $this->experience_years,
            'age_groups' => json_encode($this->age_groups),
            'my_document' => json_encode($uploadedDocuments),
            'profile_picture' => $profilePicturePath,
        ];

        if ($this->profile) {
            $this->profile->update($data);
        } else {
            ChildminderProfile::create(array_merge($data, ['user_id' => Auth::id()]));
        }

        session()->flash('message', 'Profile saved successfully!');
    }

    public function render()
    {
        return view('livewire.childminder-profile-manager')->layout('layouts.app');
    }
}
