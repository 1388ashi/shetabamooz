<?php

namespace Modules\Bootcamp\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bootcamp\Database\factories\AdvisorFactory;

class Advisor extends Model
{
    use HasFactory;
    const STATUS_NEW = 'new';

    const STATUS_ACCEPTED = 'accepted';

    protected $fillable = [
        'name','mobile','type','time','status'
    ];
    public static function getAdvisorStatues(): array
    {
        return [
            static::STATUS_NEW,
            static::STATUS_ACCEPTED,
        ];
    }
}
