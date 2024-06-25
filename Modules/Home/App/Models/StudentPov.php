<?php

namespace Modules\Home\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Kyslik\ColumnSortable\Sortable;
use Modules\Home\Database\Factories\StudentPovFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class StudentPov extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,Sortable;
    #image

    protected $fillable = [
        'name','comment','status'
    ];
    protected $sortable = [
        'name','comment','status'
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

    protected static function newFactory(): StudentPovFactory
    {
        return StudentPovFactory::new();
    }
}
