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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->unique();
            $table->string('class_no');
            $table->string('title');
            $table->integer('credit');
            $table->string('password_card')->nullable();
            $table->string('course_type');
            $table->json('teachers');
            $table->json('class_times');
            $table->integer('limit_cnt');
            $table->integer('admit_cnt');
            $table->integer('wait_cnt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
