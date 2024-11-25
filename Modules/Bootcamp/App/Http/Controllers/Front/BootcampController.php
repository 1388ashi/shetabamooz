<?php

namespace Modules\Bootcamp\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Bootcamp\App\Models\BootcampFaq;
use Modules\Bootcamp\App\Models\Headline;
use Modules\Professor\App\Models\Professor;

class BootcampController extends Controller
{
    public function show($show)
    {
        $bootcamp = Bootcamp::where('slug',$show)->first();
        if($bootcamp == null){
            abort(404);
        }
        if ($bootcamp->status == 0){
            abort(404);
        }
        $properties = json_decode($bootcamp->properties);
        $faqs = BootcampFaq::query()->where('bootcamp_id',$bootcamp->id)->get();
        $headlines = Headline::query()->latest('id')->where('bootcamp_id',$bootcamp->id)->get();
        $professors = Professor::query()
        ->with('specialties')->whereHas('bootcamps')->get();
        
        return view('bootcamp::front.show', compact('bootcamp','headlines','properties','faqs','professors'));
    }
}
