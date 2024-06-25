<?php

namespace Modules\Blog\App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Kyslik\ColumnSortable\Sortable;
use Modules\Admin\App\Models\Admin;
use Modules\Blog\Database\factories\PostFactory;
use Modules\Tag\App\Models\TypedTag;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class Post extends Model implements HasMedia, Viewable
{
    use HasTags, InteractsWithMedia,HasFactory,
        Sortable,InteractsWithViews,
        LogsActivity
        ;

    protected $fillable = [
        'title','short_description', 'description','slug',
        'slug','image_alt','meta_title','meta_description','meta_robots','canonical_tag',
        'published_at', 'admin_id','status','author',
    ];

    public $sortable = [
        'id',
        'title',
        'mobile',
        'email',
        'status',
        'created_at'
    ];

    public $appends = [
        'views_count','image','jdate','count','jdatetime'
    ];

    public function getCountAttribute(): int
    {
        return 1;
    }

    public function getJdateAttribute()
    {
        return verta($this->attributes['created_at'])->format('Y-m');
    }

    public function getJdateTimeAttribute()
    {
        return verta($this->attributes['created_at'])->format('Y-m-d');
    }

    public function getViewsCountAttribute()
    {
        return views($this)->unique()->count();
    }

    protected static function factory()
    {
        return \Modules\Blog\Database\factories\PostFactory::new();
    }

    public $sortableAs = [
//        'view_count'
    ];

    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class,'post_post_categories');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    public function recordView()
    {
        views($this)->record();
    }

    public function scopePublished($query)
    {
        return $query->where('published_at','<=',now());
    }


    //Verta package
    public static function toGregorian(string $jDate): ?string
    {

        $output = null;
        $pattern = '#^(\\d{4})/(0?[1-9]|1[012])/(0?[1-9]|[12][0-9]|3[01])$#';

        if (preg_match($pattern, $jDate)) {
            $jDateArray = explode('/', $jDate);
            $dateArray = Verta::getGregorian(
                $jDateArray[0],
                $jDateArray[1],
                $jDateArray[2]
            );
            $output = implode('/', $dateArray);
        }
        return $output;

    }


    //start media
    protected $with = [
        'media'
    ];



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



    public static function getStatus($status)
    {
        return $status= $status ? '1': '0';
    }

    public function setStatus($request)
    {
        return $status = $request->has('status') ? '1' : '0';
    }

    public function isDeletable()
    {
        return true;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }

    public function scopeSearchByMonth($query)
    {
        $startDate = \request('from_date');
        $endDate = \request('to_date');
        return $query
            ->when($startDate & $endDate, function ($query) use ($startDate, $endDate) {
                $query
                    ->whereBetween('created_at', [$startDate, $endDate]);
            });
    }

    public function scopeSearchBetweenTwoDate($query)
    {
        $startDate = \request('from_date');
        $endDate = \request('to_date');
        return $query
            ->when($startDate & $endDate, function ($query) use ($startDate, $endDate) {
                $query
                    ->whereBetween('created_at', [$startDate, $endDate]);
            });
    }
    //start search scopes

    public static function getEndDay($date): string
    {
        $jDateArray = explode('-', $date);

        return $jDateArray[1] > 6 ? '30' : '31';
    }


    public function scopeSearchKeywords($query)
    {
        return $query->when($query,function ($q) {
            return $q->where('title','LIKE','%'.\request('keyword').'%')
                ->orWhere('short_description','LIKE','%'.\request('keyword').'%')
                ->orWhere('description','LIKE','%'.\request('keyword').'%')
                ->orWhere('meta_title','LIKE','%'.\request('keyword').'%')
                ->orWhere('meta_description','LIKE','%'.\request('keyword').'%')
                ;
        });
    }


    public function addTags(array|null $tags, $onUpdate = false)
    {
        if ($tags) {
            $type = TypedTag::TYPE_BLOG;
            $onUpdate === true ?
                $this->syncTagsWithType($tags, $type) :
                $this->attachTags($tags, $type);
        }
    }

    public static function scopeCategory($query)
    {
        return !(request()->has('category')) ? $query :  $query->whereHas('categories', function ($query) {
            $query->where('name', 'LIKE', '%' . \request('category') . '%');
        });
    }


    public function scopeStatus($query)
    {
        if(!\request()->has('keyword')){
            return $query;
        }
        $status = \request()->has('status') ? \request('status') : (\request()->has('keyword') ? 0 : 1);

        return $query->where('status',$status);
    }

    public function scopeSearchByTag($query)
    {
        return !(request()->has('tags')) ? $query : $query->whereHas('tags', function($q){
            $q->where('name->en','LIKE','%'.\request('tags').'%');
        });
    }

    //end search scopes


    public static function clearAllCaches()
    {
        if (Cache::has('posts')) {
            Cache::forget('posts');
        }
    }

    public static function clearCachedModel($model_id)
    {
        $cache_key = static::getModelCacheKey($model_id);
        if (Cache::has($cache_key)) {
            Cache::forget($cache_key);
        }
    }
    public static function booted()
    {
        //Clear cache
        static::deleted(function ($post) {
            static::clearAllCaches();
        });
        static::created(function ($post) {
            static::clearAllCaches();
        });
        static::saved(function ($post) {
            static::clearAllCaches();
        });
        static::updated(function ($post) {
            static::clearAllCaches();
        });
    }

    public static function getModelCacheKey($model_id){
        return "post_".$model_id;
    }

    public function getSlugOptions(): SlugOptions
    {
    }

    public static function getTimeInJalali(): \Hekmatinasser\Verta\Verta
    {
        return \verta(now()->timezone('Asia/Tehran')->toDateString());
    }


}
