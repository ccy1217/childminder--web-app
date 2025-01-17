<?php

namespace Database\Factories;


use App\Models\ClientProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientProfile>
 */
class ClientProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Randomly associate with an existing user
            'first_name' => fake()->firstName(), // Using fake() instead of $this->faker
            'last_name' => fake()->lastName(), // Using fake() instead of $this->faker
            'children_name' => fake()->name(), // Random name for the children
            'profile_picture' => fake()->imageUrl(), // Random URL for profile picture
            'city' => fake()->city(),
            'town' => fake()->optional()->randomElement(['Springfield', 'Rivertown', 'Hill Valley', 'Sunnydale', 'Twin Peaks']), // Optional town name
            'postcode' => fake()->optional()->postcode(), // Optional postcode
            'preferred_age_groups' => json_encode(fake()->optional()->randomElements(['0-2', '3-5', '6-12', '13-18'])),
            'specific_requirements' => fake()->optional()->paragraph(), // Random specific requirements
        ];
    }
}
