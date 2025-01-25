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
        Schema::create('booking_language', function (Blueprint $table) {
            $table->primary(['booking_id', 'language_id']);
            $table->bigInteger('booking_id')->unsigned(); 
            $table->bigInteger('language_id')->unsigned(); 
            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('bookings')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('language_id')->references('id')->on('languages')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_language');
    }
};
