<?php

namespace Modules\Course\App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Kyslik\ColumnSortable\Sortable;
use Modules\Course\Database\Factories\CourseFactory;
use Modules\Professor\App\Models\Professor;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use function PHPUnit\Framework\matches;

class Course extends Model implements HasMedia, Viewable
{
    use HasFactory,Sortable,LogsActivity,InteractsWithMedia,InteractsWithViews;

    protected $fillable = [
        'title','time','sections','level','short_description',
        'description','properties','price','discount',
        'professor_id','category_id',
        'slug','image_alt','meta_title','meta_description','meta_robots','canonical_tag',

        #TODO :
           #مدرک
            #سرفصل ها
            #comment
            #سوالات متداول
    ];

    protected $appends = [
        'image'
    ];
    //start media
    protected $with = [
        'media'
    ];

    protected $hidden = ['media'];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->singleFile();
    }

    public function getImageAttribute(): ?string
    {
        $media = $this->getFirstMedia('images');
        if (!$media) {
            return asset('dist/img/default_image.jpg');
        }
        return $media->getUrl();
    }

    public function addImage($image)
    {
        if (!$image) {
            return false;
        }

        return $this->addMedia($image)->toMediaCollection('images');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')) {
            $this->addImage($request->file('image'));
        }
    }

    public function deleteImage()
    {
        $this->media()->delete();
    }
    //end media

    public function isDeletable()
    {
        return true;
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

    public function scopeSearchKeywords($query)
    {
        return $query->when(request()->filled('keyword'), function ($q) {
            $q->where('title', 'LIKE', '%' . \request('keyword') . '%')
                ->orWhere('description','LIKE','%'.\request('keyword').'%');
        });
    }

    public static function getLevelLabelAttribute($level)
    {
        return match($level){
            'beginner' => 'مقدماتی',
            'advance' => 'پیشرفته',

            default => 'error'
        };
    }

    public function getPrice(): string
    {
        return $this->price > 0 ? number_format($this->price) : 'رایگان';
    }
    public function getDiscount(): string
    {
        return $this->discount > 0 ? number_format($this->discount) : '-';
    }

    public function getJalaliCreatedAt(): string
    {
        return verta($this->created_at)->format('Y/m/d H:i');
    }

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    protected static function newFactory(): CourseFactory
    {
        return CourseFactory::new();
    }

    public function getViewsCountAttribute()
    {
        return $this->views()->count();
    }
    public function recordView()
    {
        views($this)->record();
    }
    public function CourseHeadlines(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseHeadline::class)->orderBy('order');
    }
    public function faqs()
    {
        return $this->hasMany(CourseFaq::class);
    }
    public function category()
    {
        return $this->belongsTo(CourseCategory::class,'category_id');
    }
    public function registers()
    {
        return $this->hasMany(CourseRegister::class);
    }
}
