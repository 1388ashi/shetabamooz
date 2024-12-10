<?php

namespace Modules\Bootcamp\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BootcampComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','mobile','bootcamp_id','description','status','admin_description'
    ];
    const STATUS_PENDING = 'pending';

    const STATUS_ACCEPTED = 'accepted';

    const STATUS_REJECTED = 'rejected';
    public static function getAvailableStatues(): array
    {
        return [
            static::STATUS_PENDING,
            static::STATUS_ACCEPTED,
            static::STATUS_REJECTED
        ];
    }
    public function bootcamp()
    {
        return $this->belongsTo(Bootcamp::class);
    }
}
