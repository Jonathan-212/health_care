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
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('date_of_birth');
            $table->integer('height');
            $table->integer('weight');
            $table->string('phone');
            $table->string('role')->default('patient');
            $table->string('specialist')->nullable($value = true);
            $table->text('about_doctor')->nullable($value = true);
            $table->text('doctor_university')->nullable($value = true);
            $table->string('image_url')->default('default.png');
            $table->string('notification')->default("false");
            $table->rememberToken();
            $table->timestamps();
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
