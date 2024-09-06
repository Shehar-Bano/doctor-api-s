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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob'); // Date of Birth
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time')->nullable();
            $table->string('appointment_type');
            $table->text('reason_for_appointment')->nullable();
            $table->text('medical_conditions')->nullable()->default('null');
            $table->text('medications')->nullable()->default('null');
            $table->text('allergies')->nullable()->default('null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
