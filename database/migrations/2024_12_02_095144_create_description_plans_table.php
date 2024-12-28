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
        Schema::create('description_plan', function (Blueprint $table) {
            $table->id();
            $table->string('week');
            $table->string('day');
            $table->string('meal');
            $table->foreignId('plan_id')->constrained('plans');
            $table->foreignId('food_id')->constrained('foods');

            $table->boolean('isDone')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('description_plan');
    }
};
