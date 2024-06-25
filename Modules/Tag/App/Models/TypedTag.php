<?php

namespace Modules\Tag\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Modules\Tag\Database\factories\TypedTagFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Tags\Tag;

class TypedTag extends Tag
{
    use HasFactory, Sortable, LogsActivity;

    // protected $fillable = ['status'];


    const TYPE_COURSE = 'course';
    const TYPE_BLOG = 'blog';

    protected $table = 'tags';
    public $sortable = [
        'id', 'name'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeStatus($query)
    {
        return \request()->has('status') ? $query->where('status', \request('status')) : $query;
    }

    public function scopeSearchKeyword($query)
    {
        return $query->when($query, function ($q) {
            return $q->when(request()->filled('keyword'),function($q){
                return $q->containing(\request('keyword'));
            });

        });
    }



    public static function getTags($type): \Illuminate\Support\Collection
    {
        return static::getWithType($type)->pluck('name');
    }

    protected static function newFactory()
    {

        return TypedTagFactory::new();
    }
}
