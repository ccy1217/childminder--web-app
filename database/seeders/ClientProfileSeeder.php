<?php

namespace Database\Seeders;

use App\Models\ClientProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CLientProfile::factory()->count(50)->create();
    }
}
