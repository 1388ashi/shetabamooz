<?php

namespace Modules\Bootcamp\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class BootcampGalleries extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'bootcamp_id',
        'created_at',
        'updated_at',
    ];
    protected $with = ['media'];

    protected $hidden = ['media'];

    protected $appends = ['galleries','videos'];

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('bootcamp_videos');
        $this->addMediaCollection('bootcamp_galleries');
    }

    protected function videos(): Attribute
    {
        $media = $this->getMedia('bootcamp_videos');

        $galleries = [];
        if ($media->count()) {
            foreach ($media as $mediaItem) {
                $galleries[] = [
                    'id' => $mediaItem?->id,
                    'url' => $mediaItem?->getFullUrl(),
                    'name' => $mediaItem?->file_name
                ];
            }
        }

        return Attribute::make(
            get: fn () => $galleries,
        );
    }
    protected function galleries(): Attribute
    {
        $media = $this->getMedia('bootcamp_galleries');

        $galleries = [];
        if ($media->count()) {
            foreach ($media as $mediaItem) {
                $galleries[] = [
                    'id' => $mediaItem?->id,
                    'url' => $mediaItem?->getFullUrl(),
                    'name' => $mediaItem?->file_name
                ];
            }
        }

        return Attribute::make(
            get: fn () => $galleries,
        );
    }

    public function addVideo(UploadedFile $file): bool|\Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        return $this->addMedia($file)->toMediaCollection('bootcamp_videos');
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function addGallery(UploadedFile $file): bool|\Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        return $this->addMedia($file)->toMediaCollection('bootcamp_galleries');
    }
    public function uploadFiles(Request $request): void{

        $this->uploadVideos($request);
        $this->uploadGalleries($request);
    }
    public function uploadVideos(Request $request): void
    {
        try {
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $video) {
                    if ($video->isValid()) {
                        $this->addVideo($video);
                    }
                }
            }

            if ($request->method() == 'PATCH' && $request->filled('deleted_video_ids')) {
                $this->deleteImages($request->input('deleted_video_ids'));
            }

        } catch (FileDoesNotExist $e) {
            Log::error('آپلود فایل برای دسته بندی (فایل وجود ندارد) : ' . $e->getMessage());
        } catch (FileIsTooBig $e) {
            Log::error('آپلود فایل برای دسته بندی (حجم فایل زیاد است) : ' . $e->getMessage());
        }
    }
    protected function uploadGalleries(Request $request): void
    {
        try {
            if ($request->hasFile('galleries')) {
                foreach ($request->file('galleries') as $image) {
                    if ($image->isValid()) {
                        $this->addGallery($image);
                    }
                }
            }

            if ($request->method() == 'PATCH' && $request->filled('deleted_image_ids')) {
                $this->deleteImages($request->input('deleted_image_ids'));
            }

        } catch (FileDoesNotExist $e) {
            Log::error('آپلود فایل برای دسته بندی (فایل وجود ندارد) : ' . $e->getMessage());
        } catch (FileIsTooBig $e) {
            Log::error('آپلود فایل برای دسته بندی (حجم فایل زیاد است) : ' . $e->getMessage());
        }
    }

    public function bootcamp()
    {
        return $this->belongsTo(bootcamp::class);
    }
}
