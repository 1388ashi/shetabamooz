<?php

namespace Modules\Course\App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseCategoryUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:3',[Rule::unique('course_categories')->ignore($this->category)],
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
