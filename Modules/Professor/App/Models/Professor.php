<?php

namespace Modules\Professor\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Kyslik\ColumnSortable\Sortable;
use Modules\Bootcamp\App\Models\Bootcamp;
use Modules\Core\Traits\HasAuthors;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Modules\Professor\Database\Factories\ProfessorFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Professor extends Model implements HasMedia
{
    use HasFactory,Sortable,LogsActivity,InteractsWithMedia;

    protected $fillable = [
        'name','role','description','status'
    ];

    protected $sortable =[
        'id', 'name', 'created_at','status'
    ];

    protected $appends = [
        'image'
    ];

    public static function getRoleLabelAttribute($role)
    {
        return $role;
    }

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
            $q->where('name', 'LIKE', '%' . \request('keyword') . '%')
                ->orWhere('description','LIKE','%'.\request('keyword').'%');
        });
    }

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


    public function bootcamps(): BelongsToMany
    {
        return $this->belongsToMany(Bootcamp::class);
    }
    public function specialties(): HasMany
    {
        return $this->hasMany(Specialty::class);
    }

    protected static function newFactory(): ProfessorFactory
    {
        return ProfessorFactory::new();
    }
}
