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
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_picture')->nullable();
            $table->text('about_me')->nullable();;
            $table->string('city');
            $table->string('town')->nullable();
            $table->string('postcode')->nullable();
            $table->decimal('hourly_rate', 6, 2);
            $table->text('service_scope_description')->nullable();
            $table->json('age_groups')->nullable();
            $table->string('geographical_area')->nullable();
            $table->integer('experience_years')->nullable();
            $table->json('my_document')->nullable();
            $table->boolean('is_verified')->default(false);
             $table->timestamps();
            // $table->index(['city', 'town', 'postcode']);
            // $table->index(['first_name', 'last_name']);
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