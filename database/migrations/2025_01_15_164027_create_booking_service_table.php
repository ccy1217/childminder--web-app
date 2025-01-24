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
        Schema::create('booking_service', function (Blueprint $table) {

            $table->primary(['booking_id', 'service_id']);
            $table->bigInteger('booking_id')->unsigned(); 
            $table->bigInteger('service_id')->unsigned(); 
            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('bookings')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_service');
    }
};
