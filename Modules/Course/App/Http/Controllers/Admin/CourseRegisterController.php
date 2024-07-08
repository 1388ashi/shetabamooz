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
    public function index()
    {
        $registers=CourseRegister::query()
        //            ->SearchKeyword()
                    ->orderBy('id','DESC')
                    ->with('course')
                    ->paginate(10);


                return view('course::admin.registers.index',compact('registers'));
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

    public function update(Request $request,CourseRegister $CourseRegister): RedirectResponse
    {
        $CourseRegister->update([
            'status' => $request->status,
        ]);
        $data = [
            'status' => 'success',
            'message' => 'کاربر با موفقیت به روزرسانی شد'
        ];

        return redirect()->route('admin.course-registers.index')
        ->with($data);
    }
}
