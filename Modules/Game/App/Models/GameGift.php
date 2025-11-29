<?php

namespace Modules\Game\App\Models;

use Illuminate\Database\Eloquent\Model;

class GameGift extends Model
{
    protected $fillable = ['title','gift','game_id'];
    
    public function game()
    {
        return $this->belongsTo(Game::class,'game_id');
    }
}
