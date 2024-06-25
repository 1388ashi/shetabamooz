<?php

namespace Modules\Request\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Request\App\Http\Requests\Admin\Consultation\ConsultationRequestStore;
use Modules\Request\App\Http\Requests\Admin\Consultation\ConsultationRequestUpdate;
use Modules\Request\App\Models\ConsultationRequest;

class ConsultationRequestController extends Controller
{
    public function index()
    {
        return view('request::front.consultation-requests.index');
    }

    public function store(ConsultationRequestStore $request)
    {
        $request= ConsultationRequest::create($request->all());
//        $request->uploadImage($request);

        return redirect()->back()->with('success','با موفقیت ثبت شد');
    }
}
