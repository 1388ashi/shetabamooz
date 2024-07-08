<?php

namespace Modules\Course\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Course\Database\factories\CourseRegisterFactory;

class CourseRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','mobile','email','description','status','course_id'
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
    protected static function newFactory(): CourseRegisterFactory
    {
        return CourseRegisterFactory::new();
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
