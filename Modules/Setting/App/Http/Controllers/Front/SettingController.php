<?php

namespace Modules\Setting\App\Http\Controllers\Front;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Setting\App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Cache::rememberForever('api_settings', function () {
            return Setting::query()->orderBy('group')->get(['id', 'name', 'value', 'group', 'type'])
                ->groupBy('group');
        });

        return response()->success('Get all settings', compact('settings'));
    }
}
