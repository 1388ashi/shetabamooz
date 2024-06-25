<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('search',[HomeController::class,'search'])->name('search');

Route::webSuperGroup('admin', function () {
    Route::delete('student-pov/multipleDelete', 'StudentPovController@multipleDelete')
        ->name('student-pov.multipleDelete');

    route::resource('student-povs','StudentPovController');
});
