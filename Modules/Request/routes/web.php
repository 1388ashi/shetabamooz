<?php

use Illuminate\Support\Facades\Route;
use Modules\Request\App\Http\Controllers\RequestController;

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
    Route::delete('cooperation-requests/multipleDelete', 'CooperationRequestController@multipleDelete')
        ->name('cooperation-requests.multipleDelete');

    Route::delete('consultation-requests/multipleDelete', 'ConsultationRequestController@multipleDelete')
        ->name('consultation-requests.multipleDelete');


    route::Resource('consultation-requests', 'ConsultationRequestController');
    route::Resource('cooperation-requests', 'CooperationRequestController');

});

Route::get('contact-us', [\Modules\Request\App\Http\Controllers\Front\ConsultationRequestController::class, 'index'])
    ->name('consultation-requests.index');
Route::post('consultation-requests/store', [\Modules\Request\App\Http\Controllers\Front\ConsultationRequestController::class, 'store'])
    ->name('consultation-requests.store');

Route::get('contact-us', [\Modules\Request\App\Http\Controllers\Front\CooperationRequestController::class, 'index'])
    ->name('cooperation-requests.index');
Route::post('cooperation-requests/store', [\Modules\Request\App\Http\Controllers\Front\CooperationRequestController::class, 'store'])
    ->name('cooperation-requests.store');
