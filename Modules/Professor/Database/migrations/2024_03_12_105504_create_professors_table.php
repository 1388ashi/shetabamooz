<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
            //image
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professors');
    }
};
