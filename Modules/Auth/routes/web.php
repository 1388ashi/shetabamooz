<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\Admin\AuthController;

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

Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('login', [AuthController::class, 'login'])->name('admin.login');//->middleware('throttle:login');

Route::webSuperGroup('admin', function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
