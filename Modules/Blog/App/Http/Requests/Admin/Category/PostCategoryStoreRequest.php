<?php

namespace Modules\Blog\App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:post_categories|min:3',
            'description' => 'nullable|min:3',
//            'image' => 'required'
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
