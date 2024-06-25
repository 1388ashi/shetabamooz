<?php

namespace Modules\Blog\App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostCategoryUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:3',[Rule::unique('post_categories')->ignore($this->category)],
            'description' => 'nullable|min:3|',
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
