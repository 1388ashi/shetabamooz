<?php

namespace Modules\Game\App\Http\Controllers\Admin;

use App\Exports\GameUsersExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;  
use Modules\Game\App\Models\Game;
use Modules\Game\App\Models\GameUser;

class GameUserController extends Controller
{
    public function index(Request $request,$gameId = null)  
    {  
        $games = Game::select(["id","title"])->get();  
    
        $name = $request->input('name');  
        if (!$gameId) 
            $gameId = $request->input('game_id');  
        $status = $request->input('status');  
    
        // بررسی اگر باید خروجی اکسلی بدهیم  
        if ($request->has('export') && $request->input('export') == 'excel') {  
            $users = GameUser::query()  
                ->when($gameId, function ($query) use ($gameId) {  
                    return $query->whereHas('games', function($q) use ($gameId) {  
                        return $q->where('games.id', $gameId);  
                    });  
                })  
                ->get();  
    
            return Excel::download(new GameUsersExport($users), 'game_users.xlsx');  
        }  
    
        $users = GameUser::query()  
            ->when($name, fn ($query) => $query->where('name', 'like', "%$name%"))  
            ->when($gameId, function ($query) use ($gameId) {  
                return $query->whereHas('games', function($q) use ($gameId) {  
                    return $q->where('games.id', $gameId);  
                });  
            })  
            ->when(isset($status), fn ($query) => $query->where("status", $status))  
            ->with('games:id,title')  
            ->latest('id')  
            ->paginate(15);  
    
        return view('game::admin.users.index', compact('users','games'));  
    }
    public function update(Request $request,GameUser $gameUser): RedirectResponse
    {
        $gameUser->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success','کاربر با موفقیت به روزرسانی شد');
    }
    public function changeStatusSelectedOrders(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer',
            'status' => ['required']
        ]);
        $users = GameUser::whereIn('id', $request->ids)->get();

        foreach ($users as $user) {
            $user->update([
                'status' => $request->status
            ]);
        }

        return redirect()->back()->with('success', 'تغییر وضعیت با موفقیت انجام شد.');
    }
}
