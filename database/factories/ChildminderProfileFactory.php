<?php

namespace Database\Factories;

use App\Models\ChildminderProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChildminderProfile>
 */
class ChildminderProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define possible service options
        $serviceOptions = [
            'Childcare services', // General childcare and supervision
            'Special care', // Care for children with additional needs (e.g., disabilities, medical, emotional support)
            'Meal preparation', // Providing meals, snacks, and focusing on nutrition
            'Transportation (pick-up and drop-off services)', // School runs and transport to activities
            'Educational and developmental support', // Learning activities and developmental guidance
            'Sleep and routine support' // Assistance with nap times, bedtime routines, and daily schedules
          ];
          

        return [
            'user_id' => fake()->unique()->randomElement(User::pluck('id')->toArray()),
            'first_name' => fake()->firstName(), // Random first name
            'last_name' => fake()->lastName(), // Random last name
            'profile_picture' => fake()->imageUrl(), // Random URL for profile picture
            'about_me' => fake()->paragraph(), // Random "about me" text
            'city' => fake()->city(),
            'town' => fake()->optional()->randomElement(['Springfield', 'Rivertown', 'Hill Valley', 'Sunnydale', 'Twin Peaks']),
            'postcode' => fake()->optional()->postcode(),
            'hourly_rate' => fake()->randomFloat(2, 5, 20), // Random hourly rate between 5 and 20 with 2 decimal places
            'service_scope' => json_encode(fake()->randomElements($serviceOptions, fake()->numberBetween(1, count($serviceOptions)))), // Randomly select 1 to all service options
            'age_groups' => json_encode(fake()->optional()->randomElements(['0-2', '3-5', '6-12', '13-18'])), // Convert the array to JSON
            'geographical_area' => fake()->optional()->city(), // Optional geographical area
            'experience_years' => fake()->optional()->numberBetween(1, 20), // Optional years of experience
            'my_document' => json_encode(fake()->optional()->file(public_path('storage/documents'))),
            'is_verified' => fake()->boolean(), // Randomly set verification status
        ];
    }
}
