<?php

namespace Modules\Bootcamp\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Bootcamp\App\Models\Advisor;

class AdvisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $name = request('name');
        $status = request('status');

        $advisors = Advisor::query()
        ->when($name, fn ($query) => $query->where('name', 'like', "%$name%"))
        ->when(isset($status), fn ($query) => $query->where("status", $status))
        ->latest('id')
        ->paginate(15);

        return view('bootcamp::admin.advisor.index', compact('advisors'));
    }
    public function update(Request $request,Advisor $advisor): RedirectResponse
    {
        $advisor->update([
            'status' => $request->status,
        ]);

        $data = [
            'status' => 'success',
            'message' => 'مشاوره با موفقیت به روزرسانی شد'
        ];

        return redirect()->route('admin.advisors.index')
        ->with($data);
    }
}
