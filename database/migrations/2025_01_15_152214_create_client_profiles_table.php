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
        Schema::create('client_profiles', function (Blueprint $table) {
         $table->id(); 
         $table->foreignId('user_id') // Relates client to user
          ->constrained('users')
          ->onDelete('cascade')
          ->onUpdate('cascade');
         $table->string('first_name');
         $table->string('last_name');
         $table->string('children_name');
         $table->string('profile_picture')->nullable();
         $table->string('city'); 
         $table->string('town')->nullable(); // Nullable to allow flexibility
         $table->string('postcode')->nullable();
    
         // Preferences and requirements
         $table->json('preferred_age_groups')->nullable(); // JSON for multiple age groups
         $table->text('specific_requirements')->nullable(); 
    
        $table->timestamps(); // Adds created_at and updated_at
    
         // Indexes for faster search
         $table->index(['city', 'town', 'postcode']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_profiles');
    }
};