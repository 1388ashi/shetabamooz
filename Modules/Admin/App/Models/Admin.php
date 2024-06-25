<?php

namespace Modules\Admin\App\Models;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Admin\Database\factories\AdminFactory;
use Modules\Core\Exceptions\ModelCannotBeDeletedException;
use Modules\Core\Filters\FromDateFilter;
use Modules\Core\Filters\MobileFilter;
use Modules\Core\Filters\NameFilter;
use Modules\Core\Filters\StatusFilter;
use Modules\Core\Filters\ToDateFilter;
//use Pricecurrent\LaravelEloquentFilters\Filterable;
//use Spatie\Activitylog\LogOptions;
//use Spatie\Activitylog\Traits\LogsActivity;
//use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable,InteractsWithViews;//, HasRoles, Filterable, LogsActivity,HasAuthors

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function newFactory(): AdminFactory
    {
        return AdminFactory::new();
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
//    protected function serializeDate(DateTimeInterface $date): string
//    {
//        return $date->format('Y-m-d H:i:s');
//    }

//    public function getActivitylogOptions(): LogOptions
//    {
//        return LogOptions::defaults()
//            ->logOnly($this->fillable)
//            ->setDescriptionForEvent(fn(string $eventName) => 'ادمین ' . __('logs.' . $eventName));
//    }

    //Custom methods

    public function isDeletable(): bool
    {
        return !$this->hasRole('super_admin');
    }

    protected static function booted()
    {
        static::deleting(function (Admin $admin) {
            if ($admin->hasRole('super_admin')) {
                throw new ModelCannotBeDeletedException('این ادمین سوپر ادمین می باشد و قابل حذف نمی باشد.');
            }
        });
    }

    public static function getFilters(array $inputs): array
    {
        $filters = [];
        foreach ($inputs as $key => $value) {
            switch ($key) {
                case 'name':
                    $filters[] = new NameFilter($value);
                    break;
                case 'mobile':
                    $filters[] = new MobileFilter($value);
                    break;
                case 'status':
                    $filters[] = new StatusFilter($value);
                    break;
                case 'from_date':
                    $filters[] = new FromDateFilter($value);
                    break;
                case 'to_date':
                    $filters[] = new ToDateFilter($value);
                    break;
            }
        }

        return $filters;
    }

    public function givePermissions(array $permissions, $onUpdate = false)
    {
        if (!$this->hasRole('admin')) {
            $this->assignRole('admin');
        }
        $onUpdate === true ? $this->syncPermissions($permissions) : $this->givePermissionTo($permissions);
    }

    public function getJalaliCreatedAt(): string
    {
        return verta($this->attributes['created_at'])->format('Y/m/d H:i');
    }

    public function getJalaliLastLogin(): string
    {
        return $this->attributes['last_login'] ?
            verta($this->attributes['last_login'])->format('Y/m/d H:i') :
            'تاکنون ورود نکرده است';
    }
}
