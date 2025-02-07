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
        Schema::create('childminder_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned(); 
            // Setting up the foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_picture')->nullable();
            $table->text('about_me')->nullable();;
            $table->string('city');
            $table->string('town')->nullable();
            $table->string('postcode')->nullable();
            $table->decimal('hourly_rate', 6, 2);
            $table->json('age_groups')->nullable();
            $table->integer('experience_years')->nullable();
            $table->json('my_document')->nullable();
            $table->string('provider_urn', 8)->unique(); // Max 8 chars to fit 'EY222222'
             $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('childminder_profiles');
    }
};