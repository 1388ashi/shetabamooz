<?php

namespace Modules\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Blog\App\Models\Post;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Bootcamp\App\Models\BootcampUser;
use Modules\Course\App\Models\Course;
use Modules\Course\App\Models\CourseRegister;
use Modules\Professor\App\Models\Professor;
use Modules\Request\App\Models\ConsultationRequest;
use Modules\Request\App\Models\CooperationRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $count['courses'] = Course::query()->count();
        $count['bootcamps'] = Bootcamp::query()->count();
        $count['professors'] = Professor::query()->count();
        $count['posts'] = Post::query()->count();
        $courseRegisters = CourseRegister::query()->select('id','name','mobile','course_id','status')->where('status',0)->take(10)->with('course:id,title')->get();
        $bootcampRegisters = BootcampUser::query()->select('id','name','mobile','status')->where('status','new')->take(10)->with('bootcamps:id,title')->get();
        $cooperationRequestes = CooperationRequest::query()->select('id','name','mobile','status')->where('status',0)->take(10)->get();
        $consultationRequestes = ConsultationRequest::query()->select('id','name','mobile','status')->where('status',0)->take(10)->get();

        return view('dashboard::dashboard.index',compact('count','courseRegisters','bootcampRegisters','cooperationRequestes','consultationRequestes'));
    }
}
