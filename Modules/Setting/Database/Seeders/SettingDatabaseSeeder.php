<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\App\Models\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'group' => Setting::GROUP_GENERAL,
                'name' => 'app_name',
                'label' => 'نام سایت',
                'type' => Setting::TYPE_TEXT,
                'value' => 'شتاب آموز'
            ],
            [
                'group' => Setting::GROUP_GENERAL,
                'name' => 'logo',
                'label' => 'لوگو',
                'type' => Setting::TYPE_IMAGE,
                'value' => ''
            ],
            [
                'group' => Setting::GROUP_SOCIAL,
                'name' => 'telegram',
                'label' => 'تلگرام',
                'type' => Setting::TYPE_TEXT,
                'value' => ''
            ],
            [
                'group' => Setting::GROUP_SOCIAL,
                'name' => 'instagram',
                'label' => 'اینستاگرام',
                'type' => Setting::TYPE_TEXT,
                'value' => ''
            ],
            [
                'group' => Setting::GROUP_RULES,
                'name' => 'rules_text',
                'label' => 'قوانین و مقررات',
                'type' => Setting::TYPE_TEXTAREA,
                'value' => ''
            ]
        ];

        //Insert settings
        $count = count($settings);
        for ($i = 0; $i < $count; $i++) {
            $setting = Setting::query()->firstOrCreate(
                [
                    'name' => $settings[$i]['name']
                ],
                [
                    'group' => $settings[$i]['group'],
                    'label' => $settings[$i]['label'],
                    'type' => $settings[$i]['type'],
                    'value' => $settings[$i]['value']
                ]
            );
        }
    }
}
