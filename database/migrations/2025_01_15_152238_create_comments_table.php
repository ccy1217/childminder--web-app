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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('childminder_id')->constrained('childminder_profiles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('client_id')->constrained('client_profiles')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('rating')->nullable(); // Nullable to allow plain comments
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
