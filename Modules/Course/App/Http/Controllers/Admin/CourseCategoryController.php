<?php

namespace Modules\Course\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Course\App\Http\Requests\Category\CourseCategoryStoreRequest;
use Modules\Course\App\Http\Requests\Category\CourseCategoryUpdateRequest;
use Modules\Course\App\Models\CourseCategory;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $categories=CourseCategory::query()
            ->SearchKeywords()
            ->sortable()
            ->with('courses')
            ->orderBy('id','DESC')
            ->paginate(10);

        return view('course::admin.category.index',compact('categories'));
    }

    public function store(CourseCategoryStoreRequest $request)
    {
        $category=CourseCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'admin_id' => \auth()->user()->id
        ]);

//        $category->uploadImage($request);

        //add image with spatie media
        //??
        return redirect()->route('admin.course-categories.index')
            ->with('success', 'دسته بندی با موفقیت ثبت شد.');
    }


    public function update(CourseCategoryUpdateRequest $request, CourseCategory $category)
    {
        $category->update([
            'name'=> $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $category->uploadImage($request);

        return redirect()->route('admin.course-categories.index')
            ->with('success', 'دسته بندی با موفقیت آپدیت شد.');
    }

    public function modalUpdate(CourseCategoryUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $category = CourseCategory::query()->findOrFail($request->id);
        $category->fill($request->all());
//        $category->uploadImage($request);
        $category->save();


        return redirect()->route('admin.course-categories.index')
            ->with('success', ' دسته بندی با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $category= CourseCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.course-categories.index')
            ->with('success', 'دسته بندی با موفقیت حذف شد.');

    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        CourseCategory::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "پست ها با موفقیت حذف شدند ",
        ]);

    }
}
