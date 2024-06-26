<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\App\Http\Controllers\Admin\ProfileController;
use Modules\Admin\App\Http\Controllers\Admin\AdminController;
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


Route::webSuperGroup('admin', function () {
    //profile
    Route::get('profile', [ProfileController::class, 'showProfileForm'])
        ->name('profile.form');
    Route::patch('profile', [ProfileController::class, 'updateProfile'])
        ->name('profile');
    //admins

    Route::delete('admin/multipleDelete', 'AdminController@multipleDelete')
        ->name('admins.multipleDelete');

    Route::resource('admins', AdminController::class);
});
