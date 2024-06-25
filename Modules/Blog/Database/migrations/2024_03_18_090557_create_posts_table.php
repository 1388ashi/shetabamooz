<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->Text('short_description');
            $table->longText('description');
            $table->string('author')->nullable();

            $table->string('slug')->nullable();
            $table->string('image_alt')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('meta_robots')->default(1);
            $table->text('canonical_tag')->nullable();



            $table->boolean('status')->default(0);
            //image: use spatie media
            $table->timestamp('published_at')->nullable();
            $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
//            $table->authors();
            $table->timestamps();
            //category: use 'many to many' relationship
            //tag: use spatie tag
        });
    }

     public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
