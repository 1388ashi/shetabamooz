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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('summary');
            $table->longText('description');
            $table->integer('count_users');
            $table->text('prerequisite');
            $table->string('eventplace');
            $table->string('video_link')->nullable();
            $table->string('catering')->nullable();
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
        Schema::dropIfExists('games');
    }
};
