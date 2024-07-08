<?php

namespace Modules\Course\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Course\App\Http\Requests\CourseRegister\CourseRegisterStoreRequest;
use Modules\Course\App\Models\Course;
use Modules\Course\App\Models\CourseRegister;

class CourseRegisterController extends Controller
{
    public function index()
    {
        if (\request()->course_id == null){
            abort(404);
        }
        $course = Course::findOrFail(request()->course_id);

        return view('course::front.registers.index',compact('course'));
    }

    public function store(CourseRegisterStoreRequest $request)
    {
        $course = Course::findOrFail(request()->course_id);
        CourseRegister::create($request->validated());

        return redirect()->back()->with('success',"ثبت نام شما در $course->title دوره با موفقیت انجام شد");
    }
}
