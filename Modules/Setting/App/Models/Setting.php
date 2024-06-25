<?php

namespace Modules\Setting\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Core\App\Models\BaseModel;
//use Modules\Core\App\Traits\HasCache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class Setting extends Model implements HasMedia
{
    use LogsActivity, InteractsWithMedia;

    const ACCEPTED_FILE_MIMES = 'jpg,jpeg,png,webp|mp4';

    const GROUP_GENERAL = 'general';
    const GROUP_SOCIAL = 'social';
    const GROUP_ABOUT = 'about';
    const GROUP_CONTACT = 'contact';
    const GROUP_HOME = 'home';
    const GROUP_FOOTER = 'footer';
    const GROUP_SEO = 'seo';
    const GROUP_RULES = 'rules';

    const TYPE_TEXT = 'text';
    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';

    const TYPE_NUMBER = 'number';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_BOOLEAN = 'boolean';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'group', 'label', 'name', 'type', 'value'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable)
            ->setDescriptionForEvent(fn(string $eventName) => 'تنظیمات ' . __('logs.' . $eventName));
    }

    public static function booted(): void
    {
//        static::clearAllCaches(['all_settings', 'api_settings']);
    }

    public static function getAllGroups(): array
    {
        return [
//            static::GROUP_GENERAL => [
//                'title' => 'تنظیمات عمومی',
//                'summary' => 'تنظیمات عمومی سایت مانند لوگو و تلفن و ... در این بخش قرار می گیرد.',
//                'bg' => 'primary',
//                'icon' => 'info'
//            ],
//            static::GROUP_SOCIAL => [
//                'title' => 'شبکه های اجتماعی',
//                'summary' => 'شبکه های اجتماعی مانند اینستاگرام و ... در این بخش قرار می گیرد.',
//                'bg' => 'pink',
//                'icon' => 'instagram'
//            ],
            static::GROUP_ABOUT => [
                'title' => 'گروه درباره ما',
                'summary' => 'تنظیمات درباره ما در این بخش قرار می گیرد.',
                'bg' => 'success',
                'icon' => 'paperclip'
            ],
//            static::GROUP_CONTACT => [
//                'title' => 'گروه تماس با ما',
//                'summary' => 'تنظیمات تماس با ما در این بخش قرار می گیرد.',
//                'bg' => 'warning',
//                'icon' => 'phone'
//            ],
            static::GROUP_HOME => [
                'title' => 'گروه صفحه اصلی',
                'summary' => 'تنظیمات صفحه اصلی در این بخش قرار می گیرد.',
                'bg' => 'danger',
                'icon' => 'home'
            ],
            static::GROUP_FOOTER => [
                'title' => 'گروه فوتر',
                'summary' => 'تنظیمات فوتر سایت در این بخش قرار می گیرد.    ',
                'bg' => 'warning',
                'icon' => 'list',
            ],
            static::GROUP_SEO => [
                'title' => 'گروه سئو',
                'summary' => 'تنظیمات سئو سایت در این بخش قرار می گیرد.    ',
                'bg' => 'primary',
                'icon' => 'list'
            ],
        ];
    }

    public static function getAllTypes(): array
    {
        return [
            static::TYPE_TEXT => 'متن کوتاه',
            static::TYPE_TEXTAREA => 'متن بلند',
            static::TYPE_NUMBER => 'عددی',
            static::TYPE_IMAGE => 'فایل عکس',
            static::TYPE_VIDEO => 'فایل ویدئو',
        ];
    }

    //start media
    protected $with = ['media'];

    protected $hidden = ['media', 'file'];

    protected $appends = ['file'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('setting_files')->singleFile();
    }

    public function getFileAttribute(): ?array
    {
        $media = $this->getFirstMedia('setting_files');

        return [
            'id' => $media?->id,
            'url' => $media?->getFullUrl(),
            'name' => $media?->file_name
        ];
    }


    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function addFile(UploadedFile $file): \Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        return $this->addMedia($file)->toMediaCollection('setting_files');
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function uploadFile(UploadedFile $file): void
    {
        $this->addFile($file);
    }
    //end media

    public static function getFromName($name)
    {
        return Setting::where('name', '=', $name)->first()->value ?? '';
    }

}
