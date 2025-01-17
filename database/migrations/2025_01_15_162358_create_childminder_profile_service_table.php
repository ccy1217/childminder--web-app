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
        Schema::create('childminder_profile_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('childminder_id')->constrained('childminder_profiles') 
                ->onDelete('cascade') ->onUpdate('cascade');
            $table->foreignId('service_id')->constrained('services') 
                ->onDelete('cascade') ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('childminder_profile_service');
    }
};
