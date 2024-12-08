<?php

namespace Modules\Bootcamp\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sms\Sms;

class SmsModel extends Model
{
    public static function sendSMS($code,$mobile)
    {
        $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_welcome');

        return Sms::pattern($pattern)
            ->data([
            'code' => $code,
        ])->to([$mobile])->send();
    }
}
