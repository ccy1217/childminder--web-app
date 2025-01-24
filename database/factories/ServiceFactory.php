<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $serviceOptions = [
        'Childcare services',
        'Special care',
        'Meal preparation',
        'Transportation (pick-up and drop-off services)',
        'Educational and developmental support',
        'Sleep and routine support',
    ];

    return [
        'name' => fake()->unique()->randomElement($serviceOptions), // Ensures unique names
        'description' => fake()->sentence(10), // Random description
    ];
}

}
