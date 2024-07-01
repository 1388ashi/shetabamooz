<?php

namespace Modules\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Course\App\Models\Course;
use Modules\Professor\App\Models\Professor;

class DashboardController extends Controller
{
    public function index()
    {
        $count['courses'] = Course::query()->count();
        $count['bootcamps'] = Bootcamp::query()->count();
        $count['professors'] = Professor::query()->count();

        return view('dashboard::dashboard.index',compact('count'));
    }
}
