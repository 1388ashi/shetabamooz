<?php

namespace Modules\Bootcamp\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\Core\Classes\CoreSettings;
use Modules\Sms\Sms;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Bootcamp\App\Models\Bootcamp;

class SmsBootcampUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(){}


    public function handle()  
    {  
        $this->sms();  
    }  
    
    public function sms()  
    {  
        $today = Carbon::today();  
        $tomorrow = $today->copy()->addDay();  
    
        $bootcamps = Bootcamp::whereDate('published_at', $tomorrow)->get();  
    
        if ($bootcamps->isNotEmpty()) {  
            foreach ($bootcamps as $bootcamp) {  
                if (now()->isBetween($bootcamp->published_at->subHours(2), $bootcamp->published_at)) {  
                    foreach ($bootcamp->users as $user) {  
                        $this->sendSmsBeforeTowHour($user);  
                    }  
                    Log::info('پیام با موفقیت برای همه رفت برای بوک‌ کمپ: ' . $bootcamp->id);  
                }  
            }  
        }  
        // بررسی بوک‌کمپ‌های فردا برای ارسال پیامک  
        if (Bootcamp::where('published_at', '>=', now()->addDay()->startOfDay())  
                    ->where('published_at', '<=', now()->addDay()->endOfDay())->exists()) {  
            foreach ($bootcamps as $bootcamp) {  
                foreach ($bootcamp->users as $user) {  
                    $this->sendSmsTomorrow($user);  
                }  
            }  
            Log::info('پیام با موفقیت برای همه رفت برای بوک‌کمپ‌های فردا.');  
        }  
    }  
    protected function sendSmsBeforeTowHour($user)  
    {  
        $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_bootcamp_hour_reminder');
    
        $output = Sms::pattern($pattern)  
            ->data([  
                'token' => '.',  
            ])->to([$user->mobile])->send();  
    }  
    
    protected function sendSmsTomorrow($user)  
    {  
        $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_bootcamp_day_reminder');

        $output = Sms::pattern($pattern)  
            ->data([  
                'token' => '.',  
            ])->to([$user->mobile])->send();  
    }


}
