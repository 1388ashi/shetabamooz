<?php

namespace Modules\Course\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Course\App\Http\Requests\Course\CourseStoreRequest;
use Modules\Course\App\Http\Requests\Course\CourseUpdateRequest;
use Modules\Course\App\Models\Course;
use Modules\Course\App\Models\CourseCategory;
use Modules\Professor\App\Models\Professor;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::query()
            ->SearchKeywords()
//            ->with(['teacher', 'group','testimonials','headings'])
            ->withCount('views')
            ->latest('id')
            ->paginate(10);

        return view('course::admin.course.index', compact('courses'));
    }

    public function create()
    {
        $levels = ['beginner','advance'];
        $professors = Professor::query()->latest('id')->get();
        $categories = CourseCategory::query()->latest('id')->get();

        return view('course::admin.course.create',compact('levels','professors','categories'));
    }

    public function store(CourseStoreRequest $request)
    {
        $course = Course::create($request->validated());
        $course->uploadImage($request);
//        $course->addTags($request->input('tags'));

        return redirect()->route('admin.courses.index')
            ->with('success', 'دوره با موفقیت ثبت شد.');
    }

    public function show($slug)
    {
        $course = Course::where('slug',$slug)->first();
        $properties = json_decode($course->properties);

        $course->loadCount(['courseheadlines', 'faqs']);

        return view('course::admin.course.show', compact('course','properties'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $levels = ['beginner','advance'];
        $professors = Professor::query()->latest('id')->get();
        $categories = CourseCategory::query()->latest('id')->get();
        $properties = json_decode($course->properties);

        return view('course::admin.course.edit', compact('course','levels','professors','categories','properties'));
    }

    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update($request->validated());
        $course->uploadImage($request);
//        $course->addTags($request->input('tags'), true);

        return redirect()->route('admin.courses.index')
            ->with('success', 'دوره با موفقیت به روزرسانی شد.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'دوره با موفقیت حذف شد.');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        Course::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "دوره ها با موفقیت حذف شد ",
        ]);
    }
}
