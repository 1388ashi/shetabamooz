<?php

namespace Modules\Course\App\Http\Requests\CourseRegister;

use Illuminate\Foundation\Http\FormRequest;

class CourseRegisterStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:191',
            'mobile' => 'required|regex:/(^09\d{9}$)/u',
            'description' => 'nullable|min:1',
            'email' => 'nullable|email',
            'course_id' => 'required|exists:courses,id'
        ];
    }


    public function authorize(): bool
    {
        return true;
    }
}
