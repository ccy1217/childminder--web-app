<?php

namespace Database\Seeders;

use App\Models\ChildminderProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Service;
use App\Models\language;
use Illuminate\Database\Seeder;

class ChildminderProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChildminderProfile::factory()
            ->count(50) // Create 50 childminder profiles
            ->create()
            ->each(function ($profile) {
                // Randomly take 3 services (you can adjust this number as needed)
                $services = Service::inRandomOrder()->take(3)->pluck('id');
                
                // Attach the services to the profile (pivot table)
                $profile->services()->attach($services);

                // Randomly assign languages (you can adjust this number as needed)
                $languages = Language::inRandomOrder()->take(2)->pluck('id'); // Assigning 2 languages, you can change this number
                $profile->languages()->attach($languages); // Assuming the childminder_profile_languages pivot table
            });
    }
}
