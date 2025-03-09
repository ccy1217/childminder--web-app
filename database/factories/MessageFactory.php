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
        // Get a sender who is a childminder or client
        $sender = User::whereIn('user_type', ['client', 'childminder'])->inRandomOrder()->first();

        // Determine receiver type (opposite of sender)
        $receiverType = $sender->user_type === 'client' ? 'childminder' : 'client';

        // Get a receiver with the opposite user type
        $receiver = User::where('user_type', $receiverType)->inRandomOrder()->first();

        return [
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'sender_user_type' => $sender->user_type,
            'receiver_user_type' => $receiverType,
            'message' => fake()->sentence(10),
            'is_read' => fake()->boolean(),
        ];
    }
}
