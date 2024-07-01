<?php

use Illuminate\Support\Facades\Route;

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

    Route::delete('comments.multipleDelete', 'PostCommentController@multipleDelete')
        ->name('comments.multipleDelete');

    Route::delete('post-category/multipleDelete', 'PostCategoryController@multipleDelete')
        ->name('post-categories.multipleDelete');

    Route::delete('post-comments/multipleDelete', 'PostCommentController@multipleDelete')
        ->name('post-comments.multipleDelete');



    Route::resource('post-categories', 'PostCategoryController');
    Route::resource('posts', 'PostController');
    Route::resource('post-comments', \Modules\Blog\App\Http\Controllers\Admin\PostCommentController::class)->except(['create','edit']);

    Route::delete('posts.multipleDelete', 'PostController@multipleDelete')
        ->name('posts.multipleDelete');


    Route::patch('post-categories','PostCategoryController@modalUpdate')
        ->name('post-categories.modalUpdate');

    route::post('post-comments/{comment}/makeAvailable',[\Modules\Blog\App\Http\Controllers\Admin\PostCommentController::class,'makeAvailable'])
        ->name('post-comments.makeAvailable');
    route::post('post-comments/{comment}/makeInAvailable',[\Modules\Blog\App\Http\Controllers\Admin\PostCommentController::class,'makeInAvailable'])
        ->name('post-comments.makeInAvailable');
});
Route::resource('weblogs', \Modules\Blog\App\Http\Controllers\Front\PostController::class)->only(['index','show']);
