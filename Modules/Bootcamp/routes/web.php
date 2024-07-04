<?php

use Illuminate\Support\Facades\Route;
use Modules\Bootcamp\App\Http\Controllers\Admin\AdvisorController;
use Modules\Bootcamp\App\Http\Controllers\Admin\BootcampController;
use Modules\Bootcamp\App\Http\Controllers\Admin\BootcampFaqController;
use Modules\Bootcamp\App\Http\Controllers\Admin\HeadlineController;
use Modules\Bootcamp\App\Http\Controllers\Admin\UsersController;

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
    Route::delete('bootcamps.multipleDelete', 'BootcampController@multipleDelete')
        ->name('bootcamps.multipleDelete');

        Route::delete('bootcamp-faqs/multipleDelete', 'BootcampFaqController@multipleDelete')
        ->name('bootcampfaqs.multipleDelete');


    // Route::delete('course-registers/multipleDelete', 'CourseRegisterController@multipleDelete')
    //     ->name('course-registers.multipleDelete');



    Route::Resource('bootcamps', BootcampController::class);

    route::get('bootcamp-faqs-list/{bootcamp}',[BootcampFaqController::class,'index'])->name('faqs-bootcamp');

    Route::Resource('bootcamp-faqs', BootcampFaqController::class)->except('index');

    Route::patch('headlines/sort', [HeadlineController::class, 'sort'])->name('headlines.sort');
    Route::resource('headlines', HeadlineController::class)->except([
        'create', 'show', 'edit'
    ]);
    Route::resource('users',UsersController::class);
    Route::resource('advisors',AdvisorController::class);
});

Route::Resource('bootcamps', \Modules\Bootcamp\App\Http\Controllers\Front\BootcampController::class)->only(['show']);
// Route::post('course-comments/store', [\Modules\Course\App\Http\Controllers\Front\CourseCommentController::class, 'store'])->name('course-comments.store');


// Route::get('course-registers', [\Modules\Course\App\Http\Controllers\Front\CourseRegisterController::class, 'index'])
//     ->name('course-registers.index');
// Route::post('course-registers/store', [\Modules\Course\App\Http\Controllers\Front\CourseRegisterController::class, 'store'])
//     ->name('course-registers.store');
