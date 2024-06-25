<?php

namespace Modules\Request\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Request\Database\Factories\ConsultationRequestFactory;

class ConsultationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','mobile','text','status'
    ];

    public function scopeSearchKeywords($query)
    {
        return $query->when($query,function ($q) {
            return $q->where('name','LIKE','%'.\request('keyword').'%')
                ->orWhere('mobile','LIKE','%'.\request('keyword').'%')
                ;
        });
    }


    protected static function newFactory(): ConsultationRequestFactory
    {
        return ConsultationRequestFactory::new();
    }
}
