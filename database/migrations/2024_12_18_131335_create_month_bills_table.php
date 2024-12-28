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
        Schema::create('month_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');//for doctor
            $table->boolean('isPaid')->default(0);
            $table->decimal('price',8,2);
            $table->date('billing_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('month_bills');
    }
};
