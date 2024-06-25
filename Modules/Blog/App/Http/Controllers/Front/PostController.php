<?php

namespace Modules\Blog\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Blog\App\Models\Post;
use Modules\Tag\App\Models\TypedTag;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::query()
            ->active()
            ->latest('id')
            ->paginate(10)
        ;


        $tags = TypedTag::getTags(TypedTag::TYPE_BLOG);

        return view('blog::front.post.index',compact('posts','tags'));
    }

    public function show($id)
    {
        $post=Post::findOrFail($id);
        $comments=$post->comments()->get();
        $tags = $post->tagsWithType(TypedTag::TYPE_BLOG);
        if ($post->status ==0){
            abort(404);
        }
        $related_posts = Post::query()->latest('id')->take(8)->get();#TODO

        return view('blog::front.post.show',compact('post','comments','tags','related_posts'));

    }

}
