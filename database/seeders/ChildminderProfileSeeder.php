<?php

namespace Database\Seeders;

use App\Models\ChildminderProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Service;
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
            });
    }
}
