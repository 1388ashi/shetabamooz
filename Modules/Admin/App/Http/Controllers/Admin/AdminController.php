<?php

namespace Modules\Admin\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Admin\App\Http\Requests\Admin\AdminStoreRequest;
use Modules\Admin\App\Http\Requests\Admin\AdminUpdateRequest;
use Modules\Admin\App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $filters = EloquentFilters::make(Admin::getFilters(request()->query()));
        $admins = Admin::query()
            ->with('roles')
            ->latest('id')
            ->filter($filters)
            ->select(['id', 'name', 'email', 'mobile', 'status', 'last_login', 'created_at'])
            ->paginate();

        return view('admin::admin.admin.index', compact('admins'));
    }

    public function create()
    {
        $permissions = Permission::where('guard_name', 'admin')->get(['id', 'name', 'label']);

        return view('admin::admin.admin.create', compact('permissions'));
    }

    public function store(AdminStoreRequest $request)
    {
        $admin = Admin::create($request->validated());

        //Give permissions
        if ($request->permissions) {
            $admin->givePermissions($request->input('permissions'));
        }

        return redirect()->route('admin.admins.index')
            ->with('success', 'ادمین با موفقیت ثبت شد.');
    }

    public function show(Admin $admin)
    {
        return view('admin::admin.admin.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        $permissions = Permission::where('guard_name', 'admin')->get(['id', 'name', 'label']);

        return view('admin::admin.admin.edit', compact('admin', 'permissions'));
    }

    public function update(AdminUpdateRequest $request, Admin $admin)
    {
        $admin->update($request->all());

        //sync permissions
        if ($request->permissions) {
            $admin->givePermissions($request->input('permissions'), true);
        }

        return redirect()->route('admin.admins.index')
            ->with('success', 'ادمین با موفقیت به روزرسانی شد.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'ادمین با موفقیت حذف شد.');
    }

    public function multipleDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        Admin::destroy(explode(",", $request->ids));

        return response()->json(['status' => true, 'message' => "رویداد با موفقیت حذف شد "]);

    }

}
