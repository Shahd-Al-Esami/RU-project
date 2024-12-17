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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('country')->nullable();
            $table->string('image')->nullable();
            $table->string('age')->nullable();
            $table->boolean('blocked')->default(false);

            $table->string('phone_number')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->enum('isAgreeDoctorRegistration',['pending','agree','disAgree'])->default('pending')->nullable();
            $table->enum('role',['patient','doctor','admin'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
