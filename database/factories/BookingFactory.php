<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\ClientProfile;
use App\Models\ChildminderProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate random start and end times
        $startTime = fake()->dateTimeBetween('+1 day', '+2 weeks'); // Using fake() instead of $this->faker
        $endTime = (clone $startTime)->modify('+4 hours'); // End time is 4 hours after start time

        return [
            //'client_id' => ClientProfile::factory(), // Assumes you have a ClientProfile factory
            'client_id' => ClientProfile::inRandomOrder()->first()->id, 
            'childminder_id' => ChildminderProfile::inRandomOrder()->first()->id, // Assumes you have a ChildminderProfile factory
            'start_time' => $startTime, // Random start time
            'end_time' => $endTime, // Random end time
            'notes' => fake()->sentence(10), // Random note using fake()
            'status' => fake()->randomElement(['Pending', 'Confirmed', 'Cancelled']), // Random status using fake()
        ];
    }
}
