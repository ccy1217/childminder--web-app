<?php

namespace Database\Factories;

use App\Models\ChildminderProfile;
use App\Models\ClientProfile;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'childminder_id' => ChildminderProfile::inRandomOrder()->first()->id, // Randomly associate with an existing childminder
            'client_id' => ClientProfile::inRandomOrder()->first()->id, // Randomly associate with an existing client
            'rating' => fake()->optional()->numberBetween(1, 5), // Random rating between 1 and 5 (nullable)
            'comment' => fake()->optional()->sentence(10), // Optional comment
        ];
    }
}
