<?php

use Illuminate\Support\Facades\Route;
use Modules\Professor\App\Http\Controllers\Admin\ProfessorController;
use Modules\Professor\App\Http\Controllers\Admin\SpecialtyController;

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
    Route::delete('professor/multipleDelete', 'ProfessorController@multipleDelete')
        ->name('professors.multipleDelete');
    
    Route::delete('specialties/multipleDelete', 'SpecialtyController@multipleDelete')
        ->name('specialties.multipleDelete');

    route::resource('professors','ProfessorController');

    route::get('specialties-list/{professor}',[SpecialtyController::class,'index'])->name('specialties-list');
    Route::Resource('specialties', SpecialtyController::class)->except('index');
});
