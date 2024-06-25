<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Bootcamp\App\Models\Headline;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bootcamp_headline', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Headline::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Bootcamp::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bootcamp_headline');
    }
};
