<?php

namespace Modules\Bootcamp\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Http\Requests\Faq\StoreRequest;
use Modules\Bootcamp\App\Http\Requests\Faq\UpdateRequest;
use Modules\Bootcamp\App\Models\BootcampFaq;

class BootcampFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $faqs = BootcampFaq::query()
        ->where('bootcamp_id',$id)
        ->sortable()
        ->orderBy('id','DESC')
        ->paginate(10);


    return view('bootcamp::admin.faqs.index',compact('faqs',));
    }
    public function create()
    {
        return view('bootcamp::admin.faqs.create');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreRequest $request)
    {
        $faq = BootcampFaq::create($request->validated());

        return redirect()->route('admin.faqs-bootcamp',$faq->bootcamp_id);
    }

    public function show($id)
    {
        $faq=BootcampFaq::findOrFail($id);

        return view('bootcamp::admin.faqs.show',compact('faq'));
    }


    public function edit($id)
    {
        $faq=BootcampFaq::findOrFail($id);

        return view('bootcamp::admin.faqs.edit',compact('faq'));
    }


    public function update(UpdateRequest $request, $id)
    {
        $faq=BootcampFaq::findOrFail($id);

        $faq->update($request->validated());

        return redirect()->route('admin.faqs-bootcamp',$faq->bootcamp_id);
    }

    public function destroy($id)
    {
        $faq=BootcampFaq::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.bootcamps.index');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        BootcampFaq::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "سوالات با موفقیت حذف شد "
        ]);

    }
}
