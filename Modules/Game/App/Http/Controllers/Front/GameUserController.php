<?php

namespace Modules\Game\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Core\Classes\CoreSettings;
use Modules\Sms\Sms;
use Modules\Game\App\Http\Requests\Front\User\StoreRequest;
use Modules\Game\App\Models\Game;
use Modules\Game\App\Models\GameUser;

class GameUserController extends Controller
{
    public function store(StoreRequest $request): RedirectResponse
    {
        $user = GameUser::create($request->validated());
        $user->games()->attach($request->game_id);
        $game = Game::find($request->game_id);
        $publishedAt = verta($game->published_at)->format('%B %d');
        dd($publishedAt,$game->fromhours_num);

        $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_game_register');

        $output = Sms::pattern($pattern)  
        ->data([  
            'token' => $publishedAt,  
            'token2' => $game->fromhours_num,  
        ])->to([$user->mobile])->send();  

        return redirect()->back()->with('success','شما با موفقیت در مسابقه ثبت نام شدید');
    }
}
