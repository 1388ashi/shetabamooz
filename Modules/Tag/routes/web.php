<?php

use Illuminate\Support\Facades\Route;
use Modules\Tag\App\Http\Controllers\Admin\TagController;

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

    Route::delete('tags/multipleDelete','TagController@multipleDelete')
        ->name('tags.multipleDelete');

    Route::prefix('tags')->name('tags.')->group(function() {
        Route::get('/', [TagController::class,'index'])->name('index')->middleware(['can:tag_read']);
        Route::delete('/{tag}', [TagController::class,'destroy'])->name('destroy')->middleware(['can:tag_delete']);
    });

    Route::name('tags.')->prefix('tags')->group(function(){
        Route::delete('/multipleDelete',[TagController::class,'multipleDelete'])->name('multipleDelete')
            ->middleware(['can:tag_delete']);
    });
});
