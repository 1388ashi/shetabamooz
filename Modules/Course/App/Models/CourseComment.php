<?php

namespace Modules\Course\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Kyslik\ColumnSortable\Sortable;
use Modules\Admin\App\Models\Admin;
use Modules\Course\Database\factories\CourseCommentFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use \Spatie\MediaLibrary\InteractsWithMedia;
class CourseComment extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,LogsActivity,Sortable;
    protected $fillable = [
        'course_id','name','mobile','text',
        'status','parent_id',
    ];

    public $sortable = [
        'id',
        'created_at',
        'course_id','name','mobile','text',
        'status','parent_id',
    ];


    protected static function newFactory(): CourseCommentFactory
    {
        return CourseCommentFactory::new();
    }

    public $sortableAs =[
        'course_id',
    ];

    public $appends = [
        'image'
    ];

    protected static function factory()
    {
        return CourseCommentFactory::new();
    }

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function childs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseComment::class,'parent_id');
    }


    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public static function getStatus($status): string
    {
        return $status= $status ? '1': '0';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }

    public function isDeletable(): bool
    {
        return true;
    }

    public function scopeSearchKeywords($query)
    {
        return $query->when($query,function ($q) {
            return $q->where('text','LIKE','%'.\request('keyword').'%')
                ->orWhere('name','LIKE','%'.\request('keyword').'%')
                ->orWhere('mobile','LIKE','%'.\request('keyword').'%')
                ;
        });
    }

}
