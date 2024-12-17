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
        Schema::create('meal_weeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('week_id')->constrained('weeks');
            $table->foreignId('meal_id')->constrained('meals');

            $table->boolean('isDone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_weeks');
    }
};
