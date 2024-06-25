<?php

namespace Modules\Professor\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Professor\App\Http\Requests\SpecialtyStoreRequest;
use Modules\Professor\App\Models\Specialty;

class SpecialtyController extends Controller
{
    public function index($id)
    {
        $specialties = Specialty::query()
            ->where('professor_id',$id)
            ->sortable()
            ->orderBy('id','DESC')
            ->paginate(10);


        return view('professor::admin.specialties.index',compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('professor::admin.specialties.create');
    }
    public function store(SpecialtyStoreRequest $request)
    {
        $specialty = Specialty::create($request->validated());

        return redirect()->route('admin.specialties-list',$specialty->professor_id);
    }
    public function edit($id)
    {
        $specialty=Specialty::findOrFail($id);

        return view('professor::admin.specialties.edit',compact('specialty'));
    }


    public function update(SpecialtyStoreRequest $request, $id)
    {
        $specialty=Specialty::findOrFail($id);

        $specialty->update($request->validated());

        return redirect()->route('admin.specialties-list',$specialty->professor_id);
    }

    public function destroy($id)
    {
        $specialty=Specialty::findOrFail($id);
        $specialty->delete();
        return redirect()->route('admin.professors.index');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        Specialty::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => " مشخصات با موفقیت حذف شد "
        ]);

    }
}
