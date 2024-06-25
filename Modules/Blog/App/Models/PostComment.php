<?php

namespace Modules\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Modules\Admin\App\Models\Admin;
use Modules\Blog\Database\factories\PostCommentFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PostComment extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,LogsActivity,Sortable;
    protected $fillable = [
        'post_id','name','mobile','text',
        'status','parent_id',
    ];

    public $sortable = [
        'id',
        'created_at',
        'post_id','name','mobile','text',
        'status','parent_id',
    ];

    public $sortableAs =[
        'post_id',
    ];

    public $appends = [
        'image'
    ];

    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function childs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PostComment::class,'parent_id');
    }


    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public static function getStatus($status): string
    {
        return $status= $status ? '1': '0';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }

    public function isDeletable(): bool
    {
        return true;
    }

    public function scopeSearchKeywords($query)
    {
        return $query->when($query,function ($q) {
            return $q->where('text','LIKE','%'.\request('keyword').'%')
                ->orWhere('name','LIKE','%'.\request('keyword').'%')
                ->orWhere('mobile','LIKE','%'.\request('keyword').'%')
                ;
        });
    }
    protected static function newFactory(): PostCommentFactory
    {
        return PostCommentFactory::new();
    }
}
