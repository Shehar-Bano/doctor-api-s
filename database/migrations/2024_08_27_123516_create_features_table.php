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
            $table->string('hover_img');
            $table->string('mainImg');
            $table->string('working_title');
            $table->string('work')->default(null);
            $table->string('advan')->default(null);
            $table->string('advanImg')->default(null);
            $table->string('advanImg1')->default(null);
            $table->string('question')->default(null);
            $table->string('question1')->default(null);
            $table->string('question2')->default(null);
            $table->string('question3')->default(null);
            $table->string('question4')->default(null);
            $table->string('answer')->default(null);
            $table->string('answer1')->default(null);
            $table->string('answer2')->default(null);
            $table->string('answer3')->default(null);
            $table->string('answer4')->default(null);
            $table->string('title');
            $table->string('description');
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
