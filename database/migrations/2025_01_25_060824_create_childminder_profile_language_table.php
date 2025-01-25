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
        Schema::create('childminder_profile_language', function (Blueprint $table) {
            $table->primary(['childminder_profile_id', 'language_id']);
            $table->bigInteger('childminder_profile_id')->unsigned(); 
            $table->bigInteger('language_id')->unsigned(); 
            $table->timestamps();
            $table->foreign('childminder_profile_id')->references('id')->on('childminder_profiles')
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
        Schema::dropIfExists('childminder_profile_language');
    }
};
