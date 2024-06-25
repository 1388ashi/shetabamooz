<?php

namespace Modules\Home\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Home\App\Http\Requests\StudentPovStoreRequest;
use Modules\Home\App\Http\Requests\StudentPovUpdateRequest;
use Modules\Home\App\Models\StudentPov;

class StudentPovController extends Controller
{
    public function index()
    {
        $studentPovs = StudentPov::query()
            ->latest('id')
            ->paginate(10);

        return view('home::admin.student-pov.index', compact('studentPovs'));
    }

    public function create()
    {
        return view('home::admin.student-pov.create');
    }

    public function store(StudentPovStoreRequest $request)
    {
        $studentPov = StudentPov::create($request->validated());
        $studentPov->uploadImage($request);

        return redirect()->route('admin.student-povs.index')
            ->with('success', 'نظر با موفقیت ثبت شد.');
    }

    public function show($id)
    {
        $studentPov= StudentPov::findOrFail($id);

        return view('home::admin.student-pov.show', compact('studentPov'));
    }

    public function edit($id)
    {
        $studentPov = StudentPov::findOrFail($id);

        return view('home::admin.student-pov.edit', compact('studentPov'));
    }

    public function update(StudentPovUpdateRequest $request,$id)
    {
        $pov = StudentPov::findOrFail($id);
        $pov->update($request->validated());
        $pov->uploadImage($request);

        return redirect()->route('admin.student-povs.index')
            ->with('success', 'نظر با موفقیت به روزرسانی شد.');
    }

    public function destroy(StudentPov $pov)
    {
        $pov->delete();

        return redirect()->route('admin.student-povs.index')
            ->with('success', 'نظر با موفقیت حذف شد.');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        StudentPov::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "نظر ها با موفقیت حذف شد ",
        ]);
    }
}
