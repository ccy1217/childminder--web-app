<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::inRandomOrder()->first()->id, // Randomly associate with an existing user as sender
            'receiver_id' => User::inRandomOrder()->first()->id, // Randomly associate with an existing user as receiver
            'message' => fake()->sentence(10), // Random message content
            'is_read' => fake()->boolean(), // Randomly set whether the message is read
        ];
    }
}
