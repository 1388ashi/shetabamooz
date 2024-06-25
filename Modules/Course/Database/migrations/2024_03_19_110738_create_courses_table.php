<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('time');
            $table->string('sections')->nullable();
            $table->enum('level',['beginner','advance']);
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('discount')->default(0);
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('properties')->nullable();
            $table->foreignId('professor_id')->nullable()->constrained('professors')->nullOnDelete();
            $table->boolean('status')->default(1);
            $table->string('slug')->nullable();
            $table->string('image_alt')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('meta_robots')->default(1);
            $table->text('canonical_tag')->nullable();
            $table->foreignId('category_id')->constrained('course_categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
