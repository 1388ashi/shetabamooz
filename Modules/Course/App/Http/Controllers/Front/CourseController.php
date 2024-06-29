<?php

namespace Modules\Course\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Course\App\Http\Requests\Course\CourseStoreRequest;
use Modules\Course\App\Http\Requests\Course\CourseUpdateRequest;
use Modules\Course\App\Models\Course;
use Modules\Course\App\Models\CourseCategory;
use Modules\Course\App\Models\CourseComment;
use Modules\Course\App\Models\CourseFaq;
use Modules\Course\App\Models\CourseHeadline;
use Modules\Professor\App\Models\Professor;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::query()
            ->active()
            ->SearchKeywords()
            ->latest('id')
            ->paginate(10);

        return view('course::front.course.index', compact('courses'));
    }


    public function show($id)
    {
        $course= Course::findOrFail($id);
        if ($course->status ==0){
            abort(404);
        }

        $properties = json_decode($course->properties);
        $related_courses = Course::query()->where('category_id',$course->category_id)->take(8)->get();
        $comments = CourseComment::query()->where('course_id',$course->id)->latest('id')->where('status',1)->get();
        $faqs = CourseFaq::query()->latest('id')->where('course_id',$course->id)->get();
        $headlines = CourseHeadline::query()->latest('id')->where('course_id',$course->id)->get();

        return view('course::front.course.show', compact('course','properties','related_courses','course','comments','faqs'));
    }

}
