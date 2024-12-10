<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
class DBController extends Controller
{
    public function add(){
        Schema::create('bootcamp_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bootcamp_id')->constrained('bootcamps')->cascadeOnDelete();
            $table->string('name');
            $table->string('mobile');
            $table->string('description');
            $table->string('admin_description')->nullable();
            $table->enum('status', ['pending','rejected','accepted']);
            $table->timestamps();
        });
        dd('ok');
        // Schema::table('bootcamp_comments', function (Blueprint $table) {
        //         $table->string('admin_description')->nullable();
        // });
        // dd('ok');

    }
}
