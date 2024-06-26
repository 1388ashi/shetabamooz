<?php

namespace Modules\Bootcamp\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Http\Requests\Bootcamp\StoreRequest;
use Modules\Bootcamp\App\Http\Requests\Bootcamp\UpdateRequest;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Professor\App\Models\Professor;

class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bootcamps = Bootcamp::query()
            ->SearchKeywords()
            ->with("professors:id,name")
            ->latest('id')
            ->paginate(10);

        return view('bootcamp::admin.bootcamp.index', compact('bootcamps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professors = Professor::query()->select('id','name','role')->latest('id')->where('status',1)->get();

        return view('bootcamp::admin.bootcamp.create',compact('professors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $bootcamp = Bootcamp::create($request->validated());
        $bootcamp->uploadFiles($request);

        $professors = $request->professors;
        foreach($professors as $professor) {
            $bootcamp->professors()->attach($professor);
        }

        return redirect()->route('admin.bootcamps.index')
            ->with('success', 'بوت کمپ با موفقیت ثبت شد.');
    }

    /**
     * Show the specified resource.
     */
    public function show(Bootcamp $bootcamp)
    {
        $bootcamp->loadCount(['headlines', 'bootcampfaqs']);


        return view('bootcamp::admin.bootcamp.show',compact('bootcamp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bootcamp $bootcamp)
    {
        $professors = Professor::query()->select('id','name','role')->latest('id')->where('status',1)->get();

        return view('bootcamp::admin.bootcamp.edit',compact('professors','bootcamp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,Bootcamp $bootcamp): RedirectResponse
    {
        $bootcamp->update($request->validated());
        $bootcamp->uploadFiles($request);

        $professors = $request->professors;

        $bootcamp->professors()->detach();
        foreach($professors as $professor) {
            $bootcamp->professors()->attach($professor);
        }

        return redirect()->route('admin.bootcamps.index')
            ->with('success', 'بوت کمپ با موفقیت به روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bootcamp $bootcamp)
    {
        $bootcamp->delete();

        return redirect()->route('admin.bootcamps.index')
            ->with('success', 'بوت کمپ با موفقیت حذف شد.');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        Bootcamp::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "بوت کمپ ها با موفقیت حذف شد ",
        ]);
    }
}
