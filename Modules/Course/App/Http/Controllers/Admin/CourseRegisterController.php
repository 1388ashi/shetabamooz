<?php

namespace Modules\Course\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Course\App\Http\Requests\CourseRegister\CourseRegisterStoreRequest;
use Modules\Course\App\Http\Requests\CourseRegister\CourseRegisterUpdateRequest;
use Modules\Course\App\Models\CourseRegister;

class CourseRegisterController extends Controller
{
    public function index($id)
    {
        $registers=CourseRegister::query()
            ->where('course_id',$id)
//            ->SearchKeyword()
            ->sortable()
            ->orderBy('id','DESC')
            ->paginate(10);


        return view('course::admin.registers.index',compact('registers',));
    }


    public function create()
    {
        return view('course::admin.registers.create');
    }


    public function store(CourseRegisterStoreRequest $request)
    {
        $register = CourseRegister::create($request->validated());

        return redirect()->route('admin.registers-list',$register->course_id);
    }

    public function show($id)
    {
        $register=CourseRegister::findOrFail($id);

        return view('course::admin.registers.show',compact('register'));
    }


    public function edit($id)
    {
        $register=CourseRegister::findOrFail($id);

        return view('course::admin.registers.edit',compact('register'));
    }


    public function update(CourseRegisterUpdateRequest $request, $id)
    {
        $register=CourseRegister::findOrFail($id);

        $register->update($request->validated());

        return redirect()->route('admin.registers-list',$register->course_id);
    }

    public function destroy($id)
    {
        $register=CourseRegister::findOrFail($id);
        $register->delete();
        return redirect()->route('admin.registers-list');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        CourseRegister::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "موارد با موفقیت حذف شد "
        ]);

    }
}
