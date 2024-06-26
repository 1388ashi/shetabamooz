<?php

namespace Modules\Course\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Course\App\Http\Requests\Faq\FaqStoreRequest;
use Modules\Course\App\Http\Requests\Faq\FaqUpdateRequest;
use Modules\Course\App\Models\CourseFaq;

class CourseFaqController extends Controller
{

    public function index($id)
    {
        $faqs=CourseFaq::query()
            ->where('course_id',$id)
            ->sortable()
            ->orderBy('id','DESC')
            ->paginate(10);


        return view('course::admin.faqs.index',compact('faqs',));
    }


    public function create()
    {
        return view('course::admin.faqs.create');
    }

    public function store(FaqStoreRequest $request)
    {
        $faq = CourseFaq::create($request->validated());

        return redirect()->route('admin.faqs-list',$faq->course_id);
    }

    public function show($id)
    {
        $faq=CourseFaq::findOrFail($id);

        return view('course::admin.faqs.show',compact('faq'));
    }


    public function edit($id)
    {
        $faq=CourseFaq::findOrFail($id);

        return view('course::admin.faqs.edit',compact('faq'));
    }


    public function update(FaqUpdateRequest $request, $id)
    {
        $faq=CourseFaq::findOrFail($id);

        $faq->update($request->validated());

        return redirect()->route('admin.faqs-list',$faq->course_id);
    }

    public function destroy($id)
    {
        $faq=CourseFaq::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.courses.index');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        CourseFaq::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "سوالات با موفقیت حذف شد "
        ]);

    }
}
