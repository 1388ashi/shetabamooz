<?php

namespace Modules\Game\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GameController extends Controller
{
    public function show(Game $game)
    {
        return view('game::front.games.show',compact('game'));
    }
}
