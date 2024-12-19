<?php

namespace Modules\Bootcamp\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Bootcamp\App\Models\BootcampGalleries;

class BootcampGalleriesController extends Controller
{
    public function index()
    {
        $bootcampGalleries = BootcampGalleries::query()->with('bootcamp:id,title')->paginate();
        $bootcamps = Bootcamp::query()->select('id','title')->get();

        return view('bootcamp::admin.bootcamp-galleries.index',compact('bootcampGalleries','bootcamps'));
    }
    public function store(Request $request): RedirectResponse
    {
        $bootcampGallery = BootcampGalleries::create([
            'bootcamp_id' => $request->bootcamp_id
        ]);
        $bootcampGallery->uploadFiles($request);


        return redirect()->back()->with('success',' رسانه‌ی بوتکمپ با موفقیت ثبت شد');
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $bootcampGallery = BootcampGalleries::find($id);
        $bootcampGallery->update([
            'bootcamp_id' => $request->bootcamp_id
        ]);
        $bootcampGallery->uploadFiles($request);

        return redirect()->back()->with('success',' رسانه‌ی بوتکمپ با موفقیت به روزرسانی شد');
    }
    public function destroy($id)
    {
        $bootcampGallery = BootcampGalleries::find($id);
        $bootcampGallery->delete();

        return redirect()->back()->with('success',' رسانه‌ی بوتکمپ با موفقیت حذف شد');
    }
}
