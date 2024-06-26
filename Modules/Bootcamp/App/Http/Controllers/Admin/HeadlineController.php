<?php

namespace Modules\Bootcamp\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Bootcamp\App\Http\Requests\Headline\StoreRequest;
use Modules\Bootcamp\App\Http\Requests\Headline\UpdateRequest;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Bootcamp\App\Models\Headline;

class HeadlineController extends Controller
{
    public function index(): Renderable
    {
        $bootcamp = Bootcamp::findOrFail(request()->query('bootcamp_id'));

        $headlines = Headline::query()
            ->ordered()
            ->where('bootcamp_id', $bootcamp->id)
            ->withCount('episodes')
            ->get(['id', 'title', 'bootcamp_id']);

        return view('bootcamp::admin.headline.index', compact('headlines', 'bootcamp'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        Headline::query()->create($request->validated());

        return redirect()->back()
            ->with('success', 'سرفصل با موفقیت ثبت شد.');
    }

    public function update(UpdateRequest $request, Headline $headline): RedirectResponse
    {
        $headline->update($request->validated());

        return redirect()->route('admin.headlines.index', ['bootcamp_id' => $headline->bootcamp_id])
            ->with('success', 'سرفصل با موفقیت به روزرسانی شد.');
    }

    public function destroy(Headline $headline)
    {
        $headline->delete();

        return redirect()->route('admin.headlines.index', ['bootcamp_id' => $headline->bootcamp_id])
            ->with('success', 'سرفصل با موفقیت حذف شد.');
    }

    public function sort(Request $request)
    {
        Headline::setNewOrder($request->input('headline_ids'));

        return redirect()->back()
            ->with('success', 'سرفصل ها با موفقیت مرتب سازی شدند.');
    }

}
