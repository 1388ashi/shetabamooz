<?php

namespace App\Http\Controllers;

use Modules\Core\Classes\CoreSettings;
use Modules\Core\Classes\ManuallSms;

class TestController extends Controller
{
    public function index()
    {
        $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_sms_comments');
        $output = ManuallSms::commentsReminderForBootcamp(
            $pattern,
            "09334496439",
            'بوت استرپ',
            'عرشیا بطیاری'
        );
    }
}
