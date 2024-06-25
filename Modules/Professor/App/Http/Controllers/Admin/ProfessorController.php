<?php

namespace Modules\Professor\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Professor\App\Http\Requests\Admin\Professor\ProfessorStoreRequest;
use Modules\Professor\App\Http\Requests\Admin\Professor\ProfessorUpdateRequest;
use Modules\Professor\App\Models\Professor;
use Modules\Professor\App\Models\ProfessorRole;

class ProfessorController extends Controller
{
    public function index()
{
    $professors = Professor::query()
//        ->sortable()
        ->searchkeywords()
        ->latest('id')
        ->paginate(10);

    return view('professor::admin.professor.index',compact('professors'));
}


    public function create()
    {
        return view('professor::admin.professor.create');
    }


    public function store(ProfessorStoreRequest $request)
    {
        $professor = Professor::create($request->validated());
        $professor->uploadImage($request);

        return redirect()->route('admin.professors.index')
            ->with('success', 'استاد با موفقیت ساخته شد.');
    }


    public function show(Professor $professor)
    {
        $professor->load('payments.professor','classes.group','classes.students','classStudents.class');

        return view('professor::admin.professor.show',compact('professor'));
    }


    public function edit(Professor $professor)
    {
        return view('professor::admin.professor.edit',compact('professor'));
    }


    public function update(ProfessorUpdateRequest $request, Professor $professor)
    {
        $professor->update($request->all());
        $professor->uploadImage($request);

        return redirect()->route('admin.professors.index')
            ->with('success', 'استاد با موفقیت ویرایش شد.');
    }


    public function destroy(Professor $professor)
    {
        $professor->delete();

        return redirect()->route('admin.professors.index')
            ->with('success', 'استاد موردنظر با موفقیت حذف شد.');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        Professor::destroy(explode(",", $request->ids));

        return response()->json(['status' => true, 'message' => "اساتید با موفقیت حذف شدند"]);
    }
}
