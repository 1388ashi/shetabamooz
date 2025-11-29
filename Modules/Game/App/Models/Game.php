<?php

namespace Modules\Game\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\Activitylog\LogOptions;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Bootcamp\App\Models\BootcampUser;
use Spatie\MediaLibrary\InteractsWithMedia;

class Game extends Model implements HasMedia
{
    use InteractsWithMedia,Sortable,LogsActivity;

    protected $fillable = [
        'title','subtitle','summary','description','count_users','prerequisite','eventplace','video_link',
        'fromhours','published_at','slug','image_alt','meta_title','meta_description','meta_robots','canonical_tag',
        'catering','status',
    ];
    
    protected $with = ['media'];

    protected $hidden = ['media'];

    protected $appends = ['image'];

      public function registerMediaCollections() : void
    {
        $this->addMediaCollection('game_images')->singleFile();
    }

    protected function image(): Attribute
    {
        $media = $this->getFirstMedia('game_images');

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
        return $this->addMedia($file)->toMediaCollection('game_images');
    }
      public function uploadFiles(Request $request): void{

        $this->uploadImage($request);
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
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }
     public function scopeActive($query)
    {
        return $query->where('status',1);
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
       public function getJalaliCreatedAt(): string
    {
        return verta($this->created_at)->format('Y/m/d H:i');
    }
    public function gameGifts()
    {
        return $this->hasMany(GameGift::class);
    }
    public  function gameUsers(): BelongsToMany
    {
        return $this->belongsToMany(BootcampUser::class);
    }
}
