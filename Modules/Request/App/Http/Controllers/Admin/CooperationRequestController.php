<?php

namespace Modules\Request\App\Http\Controllers\Admin;

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
        $requests = CooperationRequest::query()
            ->searchkeywords()
            ->latest('id')
            ->paginate(10);

        return view('request::admin.cooperation-requests.index',compact('requests'));
    }


    public function create()
    {
        return view('request::admin.cooperation-requests.create');
    }


    public function store(CooperationRequestStore $request)
    {
        $request= CooperationRequest::create($request->validated());
//        $request->uploadImage($request);

        return redirect()->route('admin.cooperation-requests.index');
    }


    public function show($id)
    {
        $request = CooperationRequest::findOrFail($id);

        return view('request::admin.cooperation-requests.show',compact('request'));
    }


    public function edit($id)
    {
        $request = CooperationRequest::findOrFail($id);

        return view('request::admin.cooperation-requests.edit',compact('request'));
    }

    public function update(CooperationRequestUpdate $request, $id)
    {
        $request = CooperationRequest::findOrFail($id);
        $request->update($request->validated());
//        $request->uploadImage($request);

        return redirect()->route('admin.cooperation-requests.index');
    }


    public function destroy($id)
    {
        $request = CooperationRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.cooperation-requests.index');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        CooperationRequest::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "موارد انتخابی با موفقیت حذف شدند "
        ]);

    }
}
