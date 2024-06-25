<?php

namespace Modules\Course\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Modules\Admin\App\Models\Admin;
use Modules\Blog\App\Models\Post;
use Modules\Blog\Database\Factories\PostCategoryFactory;
use Modules\Course\Database\factories\CourseCategoryFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CourseCategory extends Model implements HasMedia
{
    use InteractsWithMedia,Sortable,
        LogsActivity;


    protected static function factory(): PostCategoryFactory
    {
        return PostCategoryFactory::new();
    }

    protected $fillable = ['name','description','status','admin_id'];


    public function courses()
    {
        return $this->hasMany(Course::class,'category_id');
    }


    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function isDeletable(): bool
    {
        if ($this->courses->count()){
            return false;
        }

        return true;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeSearchKeywords($query)
    {
        return $query->when($query,function ($q) {
            return $q->where('name','LIKE','%'.\request('keyword').'%')
                ;
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }

}
