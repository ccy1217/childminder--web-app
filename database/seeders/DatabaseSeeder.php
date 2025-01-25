<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(ChildminderProfileSeeder::class); 
        $this->call(ClientProfileSeeder::class);
        $this->call(BookingSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
