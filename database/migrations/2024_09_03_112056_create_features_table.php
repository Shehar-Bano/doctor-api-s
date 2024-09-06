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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_category');
            $table->foreign('service_category')->references('id')->on('categories')->cascadeOnDelete();
            $table->string('hover_img');
            $table->string('main_img');
            $table->json('point')->nullable();;
            $table->json('titles_work')->nullable();;
            $table->text('advantage_descrip')->nullable(); // To store a list of advantages
            $table->json('questions_answers')->nullable(); // To store question-answer pairs
            $table->json('images')->nullable(); // To store multiple image paths
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
