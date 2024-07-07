<?php

namespace Modules\Bootcamp\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Bootcamp\App\Models\BootcampUser;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bootcamps = Bootcamp::select(["id","title"])->get();

        $name = request('name');
        $bootcampId = request('bootcamp_id');
        $status = request('status');

        $users = BootcampUser::query()
        ->when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
        ->when($bootcampId, function ($query) use ($bootcampId) {
            return $query->whereHas('bootcamps', function($q) use ($bootcampId) {
                return $q->where('bootcamps.id', $bootcampId);
            });
        })
        ->when(isset($status), fn ($query) => $query->where("status", $status))
        ->with('bootcamps:id,title')
        ->latest('id')
        ->paginate(15);

        return view('bootcamp::admin.users.index', compact('users','bootcamps'));
    }
    public function update(Request $request,BootcampUser $user): RedirectResponse
    {
        $user->update([
            'status' => $request->status,
        ]);
        $data = [
            'status' => 'success',
            'message' => 'کاربر با موفقیت به روزرسانی شد'
        ];

        return redirect()->route('admin.users.index')
        ->with($data);
    }
}
