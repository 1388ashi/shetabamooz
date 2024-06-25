<?php

namespace Modules\Bootcamp\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Bootcamp\Database\factories\HeadlineFactory;

class Headline extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id','title','description'
    ];
    public function bootcamps(): BelongsToMany
    {
        return $this->belongsToMany(Bootcamp::class);
    }
}
