<?php

use Illuminate\Support\Facades\Route;
use Modules\Bootcamp\App\Http\Controllers\Admin\BootcampController;

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
    Route::delete('courses.multipleDelete', 'CourseController@multipleDelete')
        ->name('courses.multipleDelete');

    Route::delete('comments.multipleDelete', 'CourseCommentController@multipleDelete')
        ->name('comments.multipleDelete');

    Route::delete('faqs/multipleDelete', 'CourseFaqController@multipleDelete')
        ->name('faqs.multipleDelete');

    Route::delete('course-category/multipleDelete', 'CourseCategoryController@multipleDelete')
        ->name('course-categories.multipleDelete');
    Route::patch('course-categories','CourseCategoryController@modalUpdate')
        ->name('course-categories.modalUpdate');

    Route::delete('course-registers/multipleDelete', 'CourseRegisterController@multipleDelete')
        ->name('course-registers.multipleDelete');



    Route::Resource('bootcamps', BootcampController::class);

    // route::get('faqs-list/{course}',[CourseFaqController::class,'index'])->name('faqs-list');

    // Route::Resource('faqs', CourseFaqController::class)->except('index');
});

// Route::Resource('courses', \Modules\Course\App\Http\Controllers\Front\CourseController::class)->only(['index','show']);
// Route::post('course-comments/store', [\Modules\Course\App\Http\Controllers\Front\CourseCommentController::class, 'store'])->name('course-comments.store');


// Route::get('course-registers', [\Modules\Course\App\Http\Controllers\Front\CourseRegisterController::class, 'index'])
//     ->name('course-registers.index');
// Route::post('course-registers/store', [\Modules\Course\App\Http\Controllers\Front\CourseRegisterController::class, 'store'])
//     ->name('course-registers.store');
