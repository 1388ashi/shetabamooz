<?php

namespace Modules\Request\App\Http\Controllers\Admin;

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
        $requests = ConsultationRequest::query()
            ->searchkeywords()
            ->latest('id')
            ->paginate(10);

        return view('request::admin.consultation-requests.index',compact('requests'));
    }


    public function create()
    {
        return view('request::admin.consultation-requests.create');
    }


    public function store(ConsultationRequestStore $request)
    {
        $request= ConsultationRequest::create($request->validated());
//        $request->uploadImage($request);

        return redirect()->route('admin.consultation-requests.index');
    }


    public function show($id)
    {
        $request = ConsultationRequest::findOrFail($id);

        return view('request::admin.consultation-requests.show',compact('request'));
    }


    public function edit($id)
    {
        $request = ConsultationRequest::findOrFail($id);

        return view('request::admin.consultation-requests.edit',compact('request'));
    }

    public function update(ConsultationRequestUpdate $request, $id)
    {
        $request = ConsultationRequest::findOrFail($id);
        $request->update($request->validated());
//        $request->uploadImage($request);

        return redirect()->route('admin.consultation-requests.index');
    }


    public function destroy($id)
    {
        $request = ConsultationRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.consultation-requests.index');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        ConsultationRequest::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "موارد انتخابی با موفقیت حذف شدند "
        ]);

    }

}
