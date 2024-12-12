<?php

namespace Modules\Bootcamp\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Bootcamp\App\Models\BootcampUser;
use Maatwebsite\Excel\Facades\Excel;  
use App\Exports\BootcampUsersExport;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)  
    {  
        $bootcamps = Bootcamp::select(["id","title"])->get();  
    
        $name = $request->input('name');  
        $bootcampId = $request->input('bootcamp_id');  
        $status = $request->input('status');  
    
        // بررسی اگر باید خروجی اکسلی بدهیم  
        if ($request->has('export') && $request->input('export') == 'excel') {  
            $users = BootcampUser::query()  
                ->when($bootcampId, function ($query) use ($bootcampId) {  
                    return $query->whereHas('bootcamps', function($q) use ($bootcampId) {  
                        return $q->where('bootcamps.id', $bootcampId);  
                    });  
                })  
                // ->take(40) 
                ->get();  
    
            return Excel::download(new BootcampUsersExport($users), 'bootcamp_users.xlsx');  
        }  
    
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
        return redirect()->back()->with('success','کاربر با موفقیت به روزرسانی شد');
    }
    public function changeStatusSelectedOrders(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:orders,id',
            'status' => ['required']
        ]);
        $users = BootcampUser::whereIn('id', $request->ids)->get();
        dd($request->all(),$users);

        foreach ($users as $user) {
            $user->update([
                'status' => $request->status
            ]);
        }
        // if (request()->header('Accept') == 'application/json') {
        //     return response()->success('تغییر وضعیت با موفقیت انجام شد.', null);
        // }
        return redirect()->back()->with('success', 'تغییر وضعیت با موفقیت انجام شد.');
    }
}
