<?php

namespace Modules\Course\App\Http\Requests\CourseRegister;

use Illuminate\Foundation\Http\FormRequest;

class CourseRegisterUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
