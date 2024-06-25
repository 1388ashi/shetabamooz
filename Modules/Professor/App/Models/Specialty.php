<?php

namespace Modules\Professor\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Professor\Database\factories\SpecialtyFactory;

class Specialty extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'text'
    ];
    public function professors(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class);
    }
}
