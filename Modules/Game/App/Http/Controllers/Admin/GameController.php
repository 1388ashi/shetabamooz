<?php

namespace Modules\Game\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Game\App\Http\Requests\Admin\Game\StoreRequest;
use Modules\Game\App\Http\Requests\Admin\Game\UpdateRequest;
use Modules\Game\App\Models\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::query()->SearchKeywords()->with('gameGifts')->latest('id')->paginate();

        return view('game::admin.games.index',compact('games'));
    }

    public function create()
    {
        return view('game::admin.games.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $game = Game::create($request->validated());
        $game->uploadFiles($request);

        return redirect()->route('admin.games.index')
            ->with('success', 'مسابقه با موفقیت ثبت شد.'); 
    }

     public function show(Game $game)
    {
        return view('game::admin.games.show',compact('game'));
    }

    public function edit(Game $game)
    {
        return view('game::admin.games.edit',compact('game'));
    }

    public function update(UpdateRequest $request, Game $game): RedirectResponse
    {
        $game->update($request->validated());
        $game->uploadFiles($request);

        return redirect()->route('admin.games.index')
            ->with('success', 'مسابقه با موفقیت به روزرسانی شد.');
    }

    public function destroy(Game $game)
    {
         $game->delete();

        return redirect()->route('admin.bootcamps.index')
            ->with('success', 'بوت کمپ با موفقیت حذف شد.');
    }
}
