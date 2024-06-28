<?php

namespace Modules\Course\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Course\Database\factories\CourseHeadlineFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class CourseHeadline extends Model implements Sortable
{
    use HasFactory,LogsActivity,SortableTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id','title','description','course_id','order_column'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable)
            ->setDescriptionForEvent(fn(string $eventName) => 'سرفصل ' . __('logs.' . $eventName));
    }

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
