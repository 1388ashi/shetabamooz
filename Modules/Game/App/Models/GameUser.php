<?php

namespace Modules\Game\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Game\Database\factories\GameUserFactory;

class GameUser extends Model
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
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }
}
