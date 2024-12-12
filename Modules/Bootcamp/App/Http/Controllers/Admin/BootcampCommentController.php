<?php

namespace Modules\Bootcamp\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Bootcamp\App\Models\BootcampComment;
use Modules\Core\Classes\CoreSettings;
use Modules\Core\Classes\ManuallSms;

class BootcampCommentController extends Controller
{
    public function index()
    {
        $bootcamps = Bootcamp::select(["id","title"])->get();
        
        if(request('send_sms') && request('bootcamp_id')){
            $bootcamp = Bootcamp::with(['users' => function($query) {  
                $query->select('id', 'name', 'mobile')->where('status', 'present');  
            }])  
            ->find(request('bootcamp_id'));
            foreach ($bootcamp->users as $user) {
                $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_sms_comments');
                $output = ManuallSms::commentsReminderForBootcamp(
                    $pattern,
                    $user->mobile,
                    $bootcamp->title,
                    $user->name
                );
                // $output = Sms::pattern($pattern)  
                // ->data([  
                //     'token' => '.',  
                // ])->to([$user->mobile])->send(); 
            }
        }
        
        $name = request('name');
        $bootcampId = request('bootcamp_id');
        $status = request('status');

        $bootcampComments = BootcampComment::query()
        ->when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
        ->when($bootcampId, function ($query) use ($bootcampId) {
            return $query->whereHas('bootcamp', function($q) use ($bootcampId) {
                return $q->where('bootcamps.id', $bootcampId);
            });
        })
        ->when(isset($status), fn ($query) => $query->where("status", $status))
        ->with('bootcamp:id,title')
        ->latest('id')
        ->paginate(15);

        return view('bootcamp::admin.bootcamp-comments.index', compact('bootcampComments','bootcamps'));
    }
    public function update(Request $request,$id): RedirectResponse
    {
        $bootcampComment = BootcampComment::find($id);

        $bootcampComment->update([
            'status' => $request->status,
            'admin_description' => $request->admin_description,
        ]);
        return redirect()->back()->with('success','نظر با موفقیت به روزرسانی شد');
    }
}
