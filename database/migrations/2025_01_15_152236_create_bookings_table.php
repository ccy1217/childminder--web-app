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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Relationships
            $table->foreignId('client_id')->constrained('client_profiles')
                  ->onDelete('cascade')->onUpdate('cascade'); 

            $table->foreignId('childminder_id')->constrained('childminder_profiles')
                  ->onDelete('cascade') ->onUpdate('cascade'); 

            // Booking Details
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->text('notes')->nullable(); // Additional information about the booking
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled', 'Completed'])->default('Pending'); // Booking status
            $table->index('status'); // Adding an index for status field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};