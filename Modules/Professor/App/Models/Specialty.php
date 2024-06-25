<?php

namespace Modules\Professor\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Specialty extends Model
{
    use HasFactory,LogsActivity,Sortable;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }
    public function isDeletable()
    {
        return true;
    }

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'description',
        'professor_id'
    ];
    public function professor(): BelongsTo
    {
        return $this->belongsTo(Professor::class);
    }
}
