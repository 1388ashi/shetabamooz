<?php

namespace Modules\Setting\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Setting\App\Http\Requests\Admin\SettingUpdateRequest;
use Modules\Setting\App\Http\Requests\SettingStoreRequest;
use Modules\Setting\App\Models\Setting;
use Spatie\MediaLibrary\MediaCollections\Exceptions\MediaCannotBeDeleted;

class SettingController extends Controller
{
    public function index(): Renderable
    {
        $groups = collect(Setting::getAllGroups());

        return view('setting::admin.index', compact('groups'));
    }

    public function store(SettingStoreRequest $request, string $group)
    {
        $validated = $request->validated();
        $validated['group'] = $group;
        Setting::query()->create($validated);

        return redirect()->route('admin.settings.edit', $group)
            ->with('success', 'کلید تنظیمات با موفقیت ثبت شد');
    }

    public function edit(string $group): Renderable
    {
        $validGroups = array_keys(Setting::getAllGroups());
        abort_unless(in_array($group, $validGroups), 403, 'Invalid group name');

        $settingTypes = Setting::query()->where('group', $group)->get()->groupBy('type');
        $types = Setting::getAllTypes();

        return view('setting::admin.edit', compact('settingTypes', 'group', 'types'));
    }


    public function update(SettingUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $inputs = $request->except(['_token', '_method']);

        foreach ($inputs as $name => $value) {
            if ($setting = Setting::where('name', $name)->first()) {
                if (in_array($setting->type, ['image', 'video']) && $value->isValid()) {
                    $setting->uploadFile($value);
                    $setting->refresh();
                    $value = $setting->file['url'];
                }
                $setting->update(['value' => $value]);
            }
        }

        return redirect()->back()
            ->with('success', 'تنظیمات با موفقیت به روزرسانی شد.');
    }

    /**
     * @throws MediaCannotBeDeleted
     */
    public function deleteFile(Setting $setting): \Illuminate\Http\RedirectResponse
    {
        abort_if(!in_array($setting->type, ['image', 'video']), 403);

        $setting->deleteMedia($setting->file['id']);
        $setting->update(['value' => null]);

        return redirect()->back()
            ->with('success', 'فایل با موفقیت حذف شد');
    }
}
