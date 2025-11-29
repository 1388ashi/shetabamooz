<?php

namespace Modules\Game\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Game\App\Http\Requests\Admin\Gift\StoreRequest;
use Modules\Game\App\Http\Requests\Admin\Gift\UpdateRequest;
use Modules\Game\App\Models\Game;
use Modules\Game\App\Models\GameGift;

class GiftController extends Controller
{
    public function create(Game $game)
    {
        return view('game::admin.gifts.create',compact('game'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        GameGift::create($request->validated());

        return redirect()->back()
            ->with('success', 'جایزه با موفقیت ثبت شد.'); 
    }

    public function edit(Game $game,GameGift $gameGift)
    {
        return view('game::admin.gifts.edit',compact('game','gameGift'));
    }

    public function update(StoreRequest $request, GameGift $gameGift): RedirectResponse
    {
         $gameGift->update($request->validated());

        return redirect()->route('admin.games.index')
            ->with('success', 'جایزه با موفقیت به روزرسانی شد.'); 
    }

    public function destroy(GameGift $gameGift)
    {
         $gameGift->delete();

        return redirect()->back()
            ->with('success', 'جایزه با موفقیت حذف شد.');
    }
}
