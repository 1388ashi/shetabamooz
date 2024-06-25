<?php

namespace Modules\Bootcamp\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Bootcamp\Database\factories\BootcampFactory;
use Modules\Professor\App\Models\Professor;

class Bootcamp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        '',
        '',
        '',
        '',
        '',
        ''
    ];
    public function professors(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class);
    }
    public function headlines(): BelongsToMany
    {
        return $this->belongsToMany(Headline::class);
    }
}
