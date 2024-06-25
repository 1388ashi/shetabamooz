<?php

namespace Modules\Blog\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\App\Http\Requests\Admin\Comment\CommentStoreRequest;
use Modules\Blog\App\Http\Requests\Admin\Comment\CommentUpdateRequest;
use Modules\Blog\App\Models\PostComment;

class PostCommentController extends Controller
{
    public function index()
    {
        $comments=PostComment::query()
            ->SearchKeywords()
            ->sortable()
            ->latest('id')
            ->paginate(10);

//        dd($comments);
        return view('blog::admin.comment.index',compact('comments'));
    }

//    public function create()
//    {
//        $posts=PostComment::query()->get();
//
//        return view('blog::admin.comment.create',compact('posts'));
//    }

    public function store(CommentStoreRequest $request)
    {
        $comments = PostComment::query()->latest('id')->get();
        $comment=PostComment::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'text' => $request->text,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);
//        $comment->uploadImage($request);


        return redirect()->route('admin.post-comments.index',compact('comments'))
            ->with('success', 'نظر شما با موفقیت ارسال شد');
    }

    public function show($id)
    {
        $comment=PostComment::findOrFail($id);

        return view('blog::admin.comment.show',compact('comment'));
    }

    public function edit($id)
    {
        $comment=PostComment::findOrFail($id);
        $posts=PostComment::query()->get();
        $comments = PostComment::query()->latest('id')->get();

        return view('blog::admin.comment.edit',compact('comment','posts','comments'));
    }

    public function update(CommentUpdateRequest $request, $id)
    {
        $comment=PostComment::findOrFail($id);

        $comment->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'text' => $request->text,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);
//        $comment->uploadImage($request);


        return redirect()->route('admin.post-comments.index')
            ->with('success', 'نظر شما با موفقیت ویرایش شد');

    }

    public function destroy($id)
    {
        $comment=PostComment::findOrFail($id);

        $comment->delete();

        return redirect()->route('admin.post-comments.index')
            ->with('success','نظر شما با موفقیت حذف شد');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        PostComment::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "کامنت ها ها با موفقیت حذف شدند ",
        ]);
    }

    public function makeAvailable($id)
    {
        $comment=PostComment::findOrFail($id);
        if($comment->status == '0'){
            $comment->update([
                'status' => '1',
            ]);
        }
        return redirect()->back();
    }

    public function makeInAvailable($id)
    {
        $comment=PostComment::findOrFail($id);
        if($comment->status == '1'){
            $comment->update([
                'status' => '0',
            ]);
        }
        return redirect()->back();
    }}
