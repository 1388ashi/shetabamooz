<?php

namespace Modules\Course\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Course\App\Http\Requests\Comment\CommentStoreRequest;
use Modules\Course\App\Http\Requests\Comment\CommentUpdateRequest;
use Modules\Course\App\Models\CourseComment;

class CourseCommentController extends Controller
{
    public function index()
    {
        $comments=CourseComment::query()
            ->SearchKeywords()
            ->sortable()
            ->latest('id')
            ->paginate(10);

//        dd($comments);
        return view('course::admin.comment.index',compact('comments'));
    }

//    public function create()
//    {
//        $courses=CourseComment::query()->get();
//
//        return view('course::admin.comment.create',compact('courses'));
//    }

    public function store(CommentStoreRequest $request)
    {
        $comments = CourseComment::query()->latest('id')->get();
        $comment=CourseComment::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'text' => $request->text,
            'course_id' => $request->course_id,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);
//        $comment->uploadImage($request);


        return redirect()->route('admin.comments.index',compact('comments'))
            ->with('success', 'نظر شما با موفقیت ارسال شد');
    }

    public function show($id)
    {
        $comment=CourseComment::findOrFail($id);

        return view('course::admin.comment.show',compact('comment'));
    }

    public function edit(CourseComment $comment)
    {
        $courses=CourseComment::query()->get();
        $comments = CourseComment::query()->latest('id')->get();

        return view('course::admin.comment.edit',compact('comment','courses','comments'));
    }

    public function update(CommentUpdateRequest $request, $id)
    {
        $comment=CourseComment::findOrFail($id);

        $comment->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'text' => $request->text,
            'course_id' => $request->course_id,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);
//        $comment->uploadImage($request);


        return redirect()->route('admin.comments.index')
            ->with('success', 'نظر شما با موفقیت ویرایش شد');

    }

    public function destroy($id)
    {
        $comment=CourseComment::findOrFail($id);

        $comment->delete();

        return redirect()->route('admin.comments.index')
            ->with('success','نظر شما با موفقیت حذف شد');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        CourseComment::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "کامنت ها ها با موفقیت حذف شدند ",
        ]);
    }

    public function makeAvailable($id)
    {
        $comment=CourseComment::findOrFail($id);
        if($comment->status == '0'){
            $comment->update([
                'status' => '1',
            ]);
        }
        return redirect()->back();
    }

    public function makeInAvailable($id)
    {
        $comment=CourseComment::findOrFail($id);
        if($comment->status == '1'){
            $comment->update([
                'status' => '0',
            ]);
        }
        return redirect()->back();
    }

}
