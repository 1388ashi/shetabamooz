<?php

namespace Modules\Blog\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Blog\App\Http\Requests\Admin\Post\PostStoreRequest;
use Modules\Blog\App\Http\Requests\Admin\Post\PostUpdateRequest;
use Modules\Blog\App\Models\Post;
use Modules\Blog\App\Models\PostCategory;
use Modules\Tag\App\Models\TypedTag;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::query()
            ->with('categories')
            ->searchKeywords()
            ->Category()
            ->SearchByMonth()
            ->Status()
            ->SearchBetweenTwoDate()
            ->sortable()
            ->orderBy('id','DESC')
            ->paginate(10)
        ;

        $postsArchives = Post::query()->latest('id')
            ->where('created_at', '>=' , now()->subDays(365)->endOfDay())
            ->get()
            ->groupBy(function ($ticket) {
                return Carbon::parse($ticket->jdate)->format('Y-m');
            });

        $tags = TypedTag::getTags(TypedTag::TYPE_BLOG);

        $categories=PostCategory::query()
            ->orderBy('id','DESC')->get();

        return view('blog::admin.post.index',compact('posts','postsArchives','categories','tags'));
    }


    public function create()
    {
        $categories=PostCategory::query()->get();
        $tags = TypedTag::getTags(TypedTag::TYPE_BLOG);

        return view('blog::admin.post.create',compact('categories','tags'));
    }


    public function store(PostStoreRequest $request)
    {

        $post=Post::create($request->validated());

        //add image
        $post->uploadImage($request);

        //add category
        if ($request->categories) {
            $post->categories()->attach($request->categories);
        }

        //add tags
        $post->addTags($request->input('tags'));


        $post->save();

        //return data
        return redirect()->route('admin.posts.index')
            ->with('success', 'پست شما با موفقیت حذف شد');
    }

    public function show($id)
    {
        $post=Post::findOrFail($id);
        $categories=$post->categories()->get();
        $comments=$post->comments()->get();
        $tags = $post->tagsWithType(TypedTag::TYPE_BLOG);

        //return data
        return view('blog::admin.post.show',compact('post','comments','tags','categories'));

    }

    public function edit($id)
    {
        $post=Post::findOrFail($id);
        $categories=PostCategory::query()->get();
        $tags = $post->tagsWithType(TypedTag::TYPE_BLOG);

        return view('blog::admin.post.edit',compact('post','categories','tags'));
    }


    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if($request->published_at != NULL){
            $request->merge([
                'published_at' => $request->published_at
            ]);
        }

        if($request->published_at == NULL){
            $request->merge([
                'published_at' => $post->published_at
            ]);
        }

        $post->update($request->validated());

        //update images
        $post->uploadImage($request);

        //update category
        if ($request->categories) {
            $post->categories()->sync($request->categories);
        }

        //update tags
        if ($request->tags) {
            $post->syncTagsWithType($request->input('tags'),TypedTag::TYPE_BLOG);
        }

        //return data
        return redirect()->route('admin.posts.index')
            ->with('success', 'پست شما با موفقیت حذف شد');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        //delete post
        $post->delete();

        //return data
        return redirect()->route('admin.posts.index')
            ->with('success', 'پست شما با موفقیت حذف شد');;
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        Post::destroy(explode(",", $request->ids));

        return response()->json([
            'status' => true,
            'message' => "دسته بندی ها با موفقیت حذف شدند ",
        ]);

    }

}
