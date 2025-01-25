<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Language>
 */
class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languageOptions = [
            'English',
            'Chinese',
            'Korean',
            'Spanish',
            'French',
            'Japanese',
        ];
        return [
           'name' => fake()->unique()->randomElement($languageOptions),
        ];
    }
}
