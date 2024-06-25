<?php

namespace Modules\Course\App\Models;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Modules\Course\Database\factories\CourseFaqFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CourseFaq extends Model implements HasMedia
{
    use HasFactory,Sortable,LogsActivity,InteractsWithMedia;

    protected $fillable = [
        'question','answer','course_id','order','status'
    ];
    protected $sortable = [
        'id','created_at', 'question','answer',
        'course_id','order','status'
    ];

    public $sortableAs = [
        'course_id',
    ];


    public static function getStatus($status)
    {

    }

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }
    protected static function newFactory(): CourseFaqFactory
    {
        return CourseFaqFactory::new();
    }

    public function isDeletable()
    {
        return true;
    }
    public function scopeSearchKeyword($query)
    {
        return $query->when($query,function ($q) {
            return $q->where('question','LIKE','%'.\request('keyword').'%')
                ->orWhere('answer','LIKE','%'.\request('keyword').'%')
                ;
        });
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
}
