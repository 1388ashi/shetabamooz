<?php

namespace Modules\Bootcamp\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bootcamp\Database\factories\BootcampCommentFactory;

class BootcampComment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): BootcampCommentFactory
    {
        //return BootcampCommentFactory::new();
    }
}
