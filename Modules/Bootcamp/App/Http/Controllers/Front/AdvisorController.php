<?php

namespace Modules\Bootcamp\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Http\Requests\Advisor\StoreRequest;
use Modules\Bootcamp\App\Models\Advisor;

class AdvisorController extends Controller
{
    public function store(StoreRequest $request)
    {
        Advisor::query()->create($request->validated());

        return redirect()->back()
            ->with('success', 'مشاوره با موفقیت ثبت شد.');
    }
}
