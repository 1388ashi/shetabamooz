<?php

namespace Modules\Course\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Course\App\Http\Requests\Comment\CommentStoreRequest;
use Modules\Course\App\Http\Requests\Comment\CommentUpdateRequest;
use Modules\Course\App\Models\CourseComment;

class CourseCommentController extends Controller
{
    public function store(CommentStoreRequest $request)
    {
        CourseComment::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'text' => $request->text,
            'course_id' => $request->course_id,
            'parent_id' => $request->parent_id,
            'status' => 0,
        ]);

        return redirect()->back()
            ->with('success', 'نظر شما با موفقیت ارسال شد');
    }
}
