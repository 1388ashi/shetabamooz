<?php

use Illuminate\Support\Facades\Route;
use Modules\About\App\Http\Controllers\Front\AboutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('about-us', [AboutController::class, 'index'])->name('about-us');
