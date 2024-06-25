<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile', 50)->unique();
            $table->string('password');
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamp('last_login')->nullable();
//            $table->authors();
            $table->timestamps();
        });
        //Create admin
        \DB::table('admins')->insert([
            'name' => 'ادمین کل',
            'email' => 'mehrabt.pc@gmail.com',
            'mobile' => '09389398757',
            'password' => bcrypt('123456'),
//            'creator_id' => 1,
//            'updater_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
