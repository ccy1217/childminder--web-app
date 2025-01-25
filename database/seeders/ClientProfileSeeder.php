<?php

namespace Database\Seeders;

use App\Models\ClientProfile;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientProfile::factory()
            ->count(50) // Create 50 childminder profiles
            ->create()
            ->each(function ($profile) {
                // Randomly assign languages (you can adjust this number as needed)
                $languages = Language::inRandomOrder()->take(2)->pluck('id'); // Assigning 2 languages, you can change this number
                $profile->languages()->attach($languages); // Assuming the childminder_profile_languages pivot table
            });
    }
}
