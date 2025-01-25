<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Language; // Assuming you have a Language model
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::factory()
            ->count(3) // Create 3 bookings (you can adjust this number as needed)
            ->create()
            ->each(function ($booking) {
                // Randomly take 2 services (you can adjust this number as needed)
                $services = Service::inRandomOrder()->take(2)->pluck('id'); // Assigning 2 services, you can change this number
                $booking->services()->attach($services); // Attach the services to the booking (pivot table)

                // Randomly assign 1 language (you can adjust this number as needed)
                $languages = Language::inRandomOrder()->take(1)->pluck('id'); // Assigning 1 language
                $booking->languages()->attach($languages); // Assuming the booking_languages pivot table
            });
    }
}
