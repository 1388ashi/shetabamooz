<?php

namespace Modules\Bootcamp\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;
use Modules\Bootcamp\Database\factories\BootcampUserFactory;

class BootcampUser extends Model
{
    use HasFactory;
    const STATUS_NEW = 'new';

    const STATUS_ACCEPTED = 'accepted';

    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'name','mobile','description','status'
    ];
    public static function getAvailableStatues(): array
    {
        return [
            static::STATUS_NEW,
            static::STATUS_ACCEPTED,
            static::STATUS_REJECTED
        ];
    }
    public function bootcamps(): BelongsToMany
    {
        return $this->belongsToMany(Bootcamp::class);
    }
}
