<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Course\App\Models\Course;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_headlines', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)->constrained()->cascadeOnDelete();
            $table->string('title'); //unique by course
            $table->string('description');
            $table->bigInteger('order_column')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_headlines');
    }
};
