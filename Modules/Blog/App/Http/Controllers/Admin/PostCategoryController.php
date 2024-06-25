<?php

namespace Modules\Blog\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\App\Http\Requests\Admin\Category\PostCategoryStoreRequest;
use Modules\Blog\App\Http\Requests\Admin\Category\PostCategoryUpdateRequest;
use Modules\Blog\App\Models\PostCategory;

class PostCategoryController extends Controller
{
    public function index()
    {
        $categories=PostCategory::query()
//            ->with('posts')
            ->SearchKeywords()
//            ->withCount('posts')
            ->sortable()
            ->with('posts')
            ->orderBy('id','DESC')
            ->paginate(10);

        return view('blog::admin.category.index',compact('categories'));
    }

    public function store(PostCategoryStoreRequest $request)
    {
        $category=PostCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'admin_id' => \auth()->user()->id
        ]);

//        $category->uploadImage($request);

        //add image with spatie media
        //??
        return redirect()->route('admin.post-categories.index')
            ->with('success', 'دسته بندی با موفقیت ثبت شد.');
    }


    public function update(PostCategoryUpdateRequest $request, PostCategory $category)
    {
        $category->update([
            'name'=> $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $category->uploadImage($request);

        return redirect()->route('admin.post-categories.index')
            ->with('success', 'دسته بندی با موفقیت آپدیت شد.');
    }

    public function modalUpdate(PostCategoryUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $category = PostCategory::query()->findOrFail($request->id);
        $category->fill($request->all());
//        $category->uploadImage($request);
        $category->save();


        return redirect()->route('admin.post-categories.index')
            ->with('success', ' دسته بندی با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $category= PostCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.post-categories.index')
            ->with('success', 'دسته بندی با موفقیت حذف شد.');

    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        PostCategory::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "پست ها با موفقیت حذف شدند ",
        ]);

    }
}
