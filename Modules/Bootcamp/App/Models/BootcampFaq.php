<?php

namespace Modules\Bootcamp\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Bootcamp\Database\factories\BootcampFaqFactory;

class BootcampFaq extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): BootcampFaqFactory
    {
        //return BootcampFaqFactory::new();
    }
}
