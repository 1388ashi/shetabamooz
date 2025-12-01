<?php

namespace Modules\Game\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\Core\Classes\CoreSettings;
use Modules\Sms\Sms;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Game\App\Models\Game;

class SmsGameUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(){}

    public function handle()  
    {  
        $today = Carbon::today();  
        $tomorrow = $today->copy()->addDay();  
    
        $games = Game::whereDate('published_at', $tomorrow)->get();  
    
        // if ($games->isNotEmpty()) {  
        //     foreach ($games as $game) {  
        //         if (now()->isBetween($game->published_at->subHours(2), $game->published_at)) {  
        //             foreach ($game->gameUsers as $user) {  
        //                 $this->sendSmsBeforeTowHour($user);  
        //             }  
        //             Log::info('پیام با موفقیت برای همه رفت برای بازی: ' . $game->id);  
        //         }  
        //     }  
        // }  
        // بررسی بازی های فردا برای ارسال پیامک  
        if (Game::where('published_at', '>=', now()->addDay()->startOfDay())  
                    ->where('published_at', '<=', now()->addDay()->endOfDay())->exists()) {  
            foreach ($games as $game) {  
                foreach ($game->gameUsers as $user) {  
                    $this->sendSmsTomorrow($game,$user);  
                }  
            }  
            Log::info('پیام با موفقیت برای همه رفت برای بوک‌کمپ‌های فردا.');  
        }  
    }  
    
  
    // protected function sendSmsBeforeTowHour($user)  
    // {  
    //     $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_game_hour_reminder');
    
    //     $output = Sms::pattern($pattern)  
    //         ->data([  
    //             'token' => '.',  
    //         ])->to([$user->mobile])->send();  
    // }  
    
    protected function sendSmsTomorrow($game,$user)  
    {  
        $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_game_day_reminder');

        $output = Sms::pattern($pattern)  
            ->data([  
                'token' => $game->fromhours_num,  
            ])->to([$user->mobile])->send();  
    }


}
