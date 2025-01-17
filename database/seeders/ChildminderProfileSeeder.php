<?php

namespace Database\Seeders;

use App\Models\ChildminderProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildminderProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChildminderProfile::factory()->count(50)->create();
    }
}
