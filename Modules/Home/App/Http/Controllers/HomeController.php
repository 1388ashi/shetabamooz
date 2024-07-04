<?php

namespace Modules\Home\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Blog\App\Models\Post;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Course\App\Models\Course;
use Modules\Home\App\Models\StudentPov;
use Modules\Professor\App\Models\Professor;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::query()->latest('id')->active()->take(8)->get();
        $professors = Professor::query()->latest('id')->active()->take(6)->get();
        $posts = Post::query()->latest('id')->active()->take(6)->get();
        $studentPovs = StudentPov::query()->latest('id')->active()->get();
        $bootcamps = Bootcamp::query()->latest('id')->take(4)->get();
        return view('home::front.home',compact('courses','professors','posts','studentPovs','bootcamps'));
    }

    public function search()
    {
        if (\request()->keyword == null){
            return redirect()->back()->with('error','لطفا متن جستجو را وارد کنید');
        }

        $courses = Course::query()->latest('id')->active()->SearchKeywords()->take(8)->get();
        $posts = Post::query()->latest('id')->active()->SearchKeywords()->take(6)->get();

        return view('home::front.search',compact('courses','posts',));
    }


}
