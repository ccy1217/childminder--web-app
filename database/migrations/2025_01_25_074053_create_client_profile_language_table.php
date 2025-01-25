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
        Schema::create('client_profile_language', function (Blueprint $table) {
            $table->primary(['client_profile_id', 'language_id']);
            $table->bigInteger('client_profile_id')->unsigned(); 
            $table->bigInteger('language_id')->unsigned(); 
            $table->timestamps();
            $table->foreign('client_profile_id')->references('id')->on('client_profiles')
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
        Schema::dropIfExists('client_profile_language');
    }
};
