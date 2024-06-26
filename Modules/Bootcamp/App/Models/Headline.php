<?php

namespace Modules\Bootcamp\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;


class Headline extends Model implements Sortable
{
    use HasFactory,LogsActivity, SortableTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id','title','description','bootcamp_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable)
            ->setDescriptionForEvent(fn(string $eventName) => 'سرفصل ' . __('logs.' . $eventName));
    }

    public function bootcamp(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bootcamp::class);
    }

}
