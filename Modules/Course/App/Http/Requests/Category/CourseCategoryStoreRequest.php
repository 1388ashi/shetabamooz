<?php

namespace Modules\Course\App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CourseCategoryStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:course_categories|min:3',
            'description' => 'nullable|min:3',
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'status' => $this->has('status')
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
