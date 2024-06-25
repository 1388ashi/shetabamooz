<?php

namespace Modules\About\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Professor\App\Models\Professor;

class AboutController extends Controller
{
    public function index()
    {
        $professors = Professor::query()->latest('id')->active()->get();

        return view('about::front.about.index',compact('professors'));
    }
}
