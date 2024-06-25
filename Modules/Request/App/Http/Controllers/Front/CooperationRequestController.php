<?php

namespace Modules\Request\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Request\App\Http\Requests\Admin\Cooperation\CooperationRequestStore;
use Modules\Request\App\Http\Requests\Admin\Cooperation\CooperationRequestUpdate;
use Modules\Request\App\Models\CooperationRequest;

class CooperationRequestController extends Controller
{
    public function index()
    {

        return view('request::front.cooperation-requests.index');
    }

    public function store(CooperationRequestStore $request)
    {
        CooperationRequest::create($request->validated());

        return redirect()->back()->with('success','با موفقیت ثبت شد');
    }
}
