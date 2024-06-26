<?php

namespace Modules\Bootcamp\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Modules\Bootcamp\Database\factories\BootcampFaqFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BootcampFaq extends Model
{
    use HasFactory,Sortable,LogsActivity;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'question','answer','bootcamp_id'
    ];
    protected $sortable = [
        'id','created_at', 'question','answer',
        'bootcamp_id'
    ];

    public $sortableAs = [
        'bootcamp_id',
    ];

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }

    public function isDeletable()
    {
        return true;
    }
    public function scopeSearchKeyword($query)
    {
        return $query->when($query,function ($q) {
            return $q->where('question','LIKE','%'.\request('keyword').'%')
                ->orWhere('answer','LIKE','%'.\request('keyword').'%')
                ;
        });
    }
    public function bootcamp()
    {
        return $this->belongsTo(Bootcamp::class,'bootcamp_id');
    }

}
