<?php

namespace Modules\Bootcamp\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Http\Requests\User\StoreRequest;
use Modules\Core\Classes\CoreSettings;
use Modules\Sms\Sms;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Bootcamp\App\Models\BootcampUser;

class UsersController extends Controller
{
    public function index()
    {
        if (\request()->bootcamp_id == null){
            abort(404);
        }
        $bootcamp = Bootcamp::findOrFail(request()->bootcamp_id);

        return view('bootcamp::front.create',compact('bootcamp'));
    }
    public function store(StoreRequest $request)
    {
        $user = BootcampUser::create($request->validated());
        $user->bootcamps()->attach($request->bootcamp_id);

        $pattern = app(CoreSettings::class)->get('sms.shetabamooz_bootcamp_day_reminder');
        $output = Sms::pattern($pattern)  
        ->data([  
            'token' => '.',  
        ])->to([$user->mobile])->send();  

        return redirect()->back()->with('success','شما با موفقیت در بوت کمپ ثبت نام شدید');
    }
}
