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
        Schema::create('bootcamps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('summary');
            $table->longText('description');
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('discount')->nullable();
            $table->text('prerequisite');
            $table->text('contacts');
            $table->string('time');
            $table->string('type');
            $table->string('eventplace');
            $table->string('support');
            $table->string('catering')->nullable();
            $table->string('gifts')->nullable();
            $table->boolean('status')->default(1);
            $table->string('fromhours');
            $table->timestamp('published_at');
            $table->string('slug');
            $table->string('image_alt')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('meta_robots')->default(1);
            $table->text('canonical_tag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bootcamps');
    }
};
