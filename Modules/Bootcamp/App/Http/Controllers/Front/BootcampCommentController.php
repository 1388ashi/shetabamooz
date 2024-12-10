<?php

namespace Modules\Bootcamp\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Http\Requests\BootcampComment\StoreRequest;
use Modules\Bootcamp\App\Models\BootcampComment;

class BootcampCommentController extends Controller
{
    public function store(StoreRequest $request)
    {
        $bootcampComment = BootcampComment::create($request->validated());

        return redirect()->back()->with('success','نظر شما با موفقیت در سایت ثبت شد');
    }
}
