<?php

namespace Modules\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blog\Database\factories\PostPostCategoryFactory;

class PostPostCategory extends Model
{
    use HasFactory;
    protected $table='post_post_categories';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): PostPostCategoryFactory
    {
        //return PostPostCategoryFactory::new();
    }
}
