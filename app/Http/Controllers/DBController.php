<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Modules\Bootcamp\App\Models\BootcampUser;
use Modules\Core\Classes\CoreSettings;
use Modules\Sms\Sms;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Bootcamp\App\Models\Bootcamp;
class DBController extends Controller
{
    public function add(){
        // Schema::create('bootcamp_comments', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('bootcamp_id')->constrained('bootcamps')->cascadeOnDelete();
        //     $table->string('name');
        //     $table->string('mobile');
        //     $table->string('description');
        //     $table->string('admin_description')->nullable();
        //     $table->enum('status', ['pending','rejected','accepted']);
        //     $table->timestamps();
        // });
        // dd('ok');
        // $users = BootcampUser::latest('id')->take(10)->get();   
                
        // foreach ($users as $user) {  
        //     $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_bootcamp_day_reminder');
        
        //     $output = Sms::pattern($pattern)  
        //         ->data([  
        //             'token' => '.',  
        //         ])->to([$user->mobile])->send();  
        // }  
        // dd('ok');
        $bootcamp = Bootcamp::with('users')->find(3);
            foreach ($bootcamp->users as $user) {  
                $pattern = app(CoreSettings::class)->get('sms.patterns.shetabamooz_bootcamp_hour_reminder');
    
                $output = Sms::pattern($pattern)  
                    ->data([  
                        'token' => '.',  
                    ])->to([$user->mobile])->send();  
            }  
    }
    
}
