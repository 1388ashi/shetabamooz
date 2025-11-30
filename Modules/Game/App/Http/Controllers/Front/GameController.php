<?php

namespace Modules\Game\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Game\App\Models\Game;
use Modules\Game\App\Models\GameUser;

class GameController extends Controller
{
    public function show($slug)
    {
        $game = Game::where('slug',$slug)->first();
        $countUsers = GameUser::whereHas('games', function ($query) use ($game) {  
            return $query->where('games.id', $game->id);  
        })->count();

        return view('game::front.games.show',compact('game','countUsers'));
    }
}
