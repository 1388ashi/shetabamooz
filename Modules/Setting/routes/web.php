<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\App\Http\Controllers\Admin\SettingController;

Route::webSuperGroup('admin', function () {
    Route::get('settings', [SettingController::class, 'index'])
//        ->middleware(['permission:view settings'])
        ->name('settings.index');
    Route::post('settings/{group}', [SettingController::class, 'store'])
//        ->middleware(['permission:create settings'])
        ->name('settings.store');
    Route::get('settings/{setting}', [SettingController::class, 'edit'])
//        ->middleware(['permission:view settings'])
        ->name('settings.edit');
    Route::patch('settings', [SettingController::class, 'update'])
//        ->middleware(['permission:edit settings'])
        ->name('settings.update');
    Route::delete('/settings/{setting}/file', [SettingController::class, 'deleteFile'])
//        ->middleware(['permission:edit settings'])
        ->name('settings.deleteFile');
});
