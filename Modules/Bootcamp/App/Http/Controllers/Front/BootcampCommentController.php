<?php

namespace Modules\Bootcamp\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Sms\Sms;
use Modules\Bootcamp\App\Http\Requests\BootcampComment\StoreRequest;
use Modules\Bootcamp\App\Models\BootcampComment;
use Modules\Core\Classes\CoreSettings;

class BootcampCommentController extends Controller
{
    public function store(StoreRequest $request)
    {
        $bootcampComment = BootcampComment::create($request->validated());
        $bootcamp = Bootcamp::select('id','link_video')->find($request->bootcamp_id);
        $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_bootcamp_comment_video');
        $output = Sms::pattern($pattern)  
        ->data([  
            'token' => '.',  
            'token2' => $bootcamp->link_video,  
        ])->to([$bootcampComment->mobile])->send();  

        return redirect()->back()->with('success','نظر شما با موفقیت در سایت ثبت شد');
    }
}
