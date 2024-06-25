<?php

namespace Modules\Tag\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Tag\App\Models\TypedTag;

class TagController extends Controller
{
    public function index()
    {
        $tagTypes = [TypedTag::TYPE_BLOG,TypedTag::TYPE_COURSE];
        $tags = TypedTag::SearchKeyword()
            ->sortable()
            ->latest('id')
            ->paginate(10)
            ->appends(request()->query());

        return view('tag::admin.index',compact('tags','tagTypes'));
    }

    public function create()
    {
        return view('tag::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('tag::show');
    }

    public function edit($id)
    {
        return view('tag::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($tag)
    {
        //
        $tag = TypedTag::findOrFail($tag);

        $tag->delete();
        // $msgPrefix = Contact::LABEL['singular'];

        return redirect()->route('admin.tags.index')->with([
            'success' => 'با موفقیت حذف شد تگ ',
        ]);
    }


    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        TypedTag::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "سوالات با موفقیت حذف شد "
        ]);

    }
}
