<?php

namespace Modules\Course\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Course\App\Http\Requests\Headline\StoreRequest;
use Modules\Course\App\Http\Requests\Headline\UpdateRequest;
use Modules\Course\App\Models\Course;
use Modules\Course\App\Models\CourseHeadline;

class HeadlineController extends Controller
{
    public function index(): Renderable
    {
        $course = Course::findOrFail(request()->query('course_id'));

        $headlines = CourseHeadline::query()
            ->ordered()
            ->where('course_id', $course->id)
            ->get(['id', 'title','description','order_column', 'course_id']);

        return view('course::admin.headline.index', compact('headlines', 'course'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        CourseHeadline::query()->create($request->validated());

        return redirect()->back()
            ->with('success', 'سرفصل با موفقیت ثبت شد.');
    }

    public function update(UpdateRequest $request, CourseHeadline $courseHeadline): RedirectResponse
    {
        $courseHeadline->update($request->validated());

        return redirect()->route('admin.course-headlines.index', ['course_id' => $courseHeadline->course_id])
            ->with('success', 'سرفصل با موفقیت به روزرسانی شد.');
    }

    public function destroy(CourseHeadline $courseHeadline)
    {
        $courseHeadline->delete();

        return redirect()->route('admin.course-headlines.index', ['course_id' => $courseHeadline->course_id])
            ->with('success', 'سرفصل با موفقیت حذف شد.');
    }

    public function sort(Request $request)
    {
        CourseHeadline::setNewOrder($request->input('headline_ids'));

        return redirect()->back()
            ->with('success', 'سرفصل ها با موفقیت مرتب سازی شدند.');
    }
}
