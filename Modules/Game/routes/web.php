<?php

use Illuminate\Support\Facades\Route;
use Modules\Game\App\Http\Controllers\Admin\GameController;
use Modules\Game\App\Http\Controllers\Admin\GameUserController;
use Modules\Game\App\Http\Controllers\Admin\GiftController;

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
    Route::Resource('games', GameController::class);
    Route::Resource('game-gifts', GiftController::class)->except(['create','edit','show']);
    route::get('game-gifts/{game}',[GiftController::class,'create'])->name('game-gifts.create');
    route::get('game-gifts/{game}/{gameGift}/edit',[GiftController::class,'edit'])->name('game-gifts.edit');

    Route::get('game-users/{id?}',[GameUserController::class,'index'])->name('game-users.index');
    Route::patch('game-users/{GameUser}', [GameUserController::class,'update'])->name('game-users.update');
    Route::post('/status/changes', [GameUserController::class,'changeStatusSelectedOrders'])->name('game-users.changeStatusSelectedUsers');

    
});

Route::Resource('bootcamps', \Modules\Game\App\Http\Controllers\Front\GameController::class)->only(['show']);
