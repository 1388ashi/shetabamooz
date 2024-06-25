<?php

namespace Modules\Request\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Request\Database\Factories\CooperationRequestFactory;

class CooperationRequest extends Model
{
    use HasFactory;


    protected $fillable = [
        'name','mobile','email','resume','status'
    ];

    public function scopeSearchKeywords($query)
    {
        return $query->when($query,function ($q) {
            return $q->where('name','LIKE','%'.\request('keyword').'%')
                ->orWhere('email','LIKE','%'.\request('keyword').'%')
                ->orWhere('mobile','LIKE','%'.\request('keyword').'%')
                ;
        });
    }

    protected static function newFactory(): CooperationRequestFactory
    {
        return CooperationRequestFactory::new();
    }
}
