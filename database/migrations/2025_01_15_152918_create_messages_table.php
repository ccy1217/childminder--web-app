<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            //this is the same as --> $table->foreignId('sender_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to 'users' table for the sender
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // Foreign key to 'users' table for the receiver
            $table->text('message'); // Message content
            $table->boolean('is_read')->default(false); // Whether the message has been read
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};