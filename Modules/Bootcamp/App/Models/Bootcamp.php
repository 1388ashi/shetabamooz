<?php

namespace Modules\Bootcamp\App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Kyslik\ColumnSortable\Sortable;
use Modules\Professor\App\Models\Professor;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Bootcamp extends Model implements HasMedia, Viewable
{
    use HasFactory,Sortable,LogsActivity,InteractsWithMedia,InteractsWithViews;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title','subtitle','eventplace','support','catering','gifts'
        ,'summary','description','published_at','price'
        ,'discount','prerequisite','contacts','time','status',
    ];

     //start media-library
    protected $with = ['media'];

    protected $hidden = ['media'];

    protected $appends = ['image','video'];

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('bootcamp_images')->singleFile();
        $this->addMediaCollection('bootcamp_videos')->singleFile();
    }

    protected function image(): Attribute
    {
        $media = $this->getFirstMedia('bootcamp_images');

        return Attribute::make(
            get: fn () => [
                'id' => $media?->id,
                'url' => $media?->getFullUrl(),
                'name' => $media?->file_name
            ],
        );
    }
    protected function video(): Attribute
    {
        $media = $this->getFirstMedia('bootcamp_videos');

        return Attribute::make(
            get: fn () => [
                'id' => $media?->id,
                'url' => $media?->getFullUrl(),
                'name' => $media?->file_name
            ],
        );
    }
    /**
     * @throws FileDoesNotExist
    * @throws FileIsTooBig
    */
    public function addImage(UploadedFile $file): bool|\Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        return $this->addMedia($file)->toMediaCollection('bootcamp_images');
    }

    public function addVideo(UploadedFile $file): bool|\Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        return $this->addMedia($file)->toMediaCollection('bootcamp_videos');
    }
    public function uploadFiles(Request $request): void{

        $this->uploadImage($request);
        $this->uploadVideo($request);
    }
    public function uploadImage(Request $request): void
    {
        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $this->addImage($request->file('image'));
            }
        } catch (FileDoesNotExist $e) {
            Log::error('Product upload file (FileDoesNotExist): ' . $e->getMessage());
        }catch (FileIsTooBig $e) {
            Log::error('Product upload file (FileIsTooBig): ' . $e->getMessage());
        }
    }
    public function uploadVideo(Request $request): void
    {
        try {
            if ($request->hasFile('video') && $request->file('video')->isValid()) {
                $this->addVideo($request->file('video'));
            }
        } catch (FileDoesNotExist $e) {
            Log::error('Product upload file (FileDoesNotExist): ' . $e->getMessage());
        }catch (FileIsTooBig $e) {
            Log::error('Product upload file (FileIsTooBig): ' . $e->getMessage());
        }
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
    public function isDeletable()
    {
        return true;
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

    public function professors(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class);
    }
    public function headlines(): BelongsToMany
    {
        return $this->belongsToMany(Headline::class);
    }
}
