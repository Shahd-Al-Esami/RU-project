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
        Schema::create('ingredient_food', function (Blueprint $table) {
            $table->id();
           $table->foreignId('food_id')->constrained('foods')->cascadeOnDelete;
           $table->foreignId('ingredient_id')->constrained('ingredients')->cascadeOnDelete();
           $table->timestamps();
           $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_food');
    }
};
