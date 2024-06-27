<?php

namespace Modules\Course\App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Helpers\Helpers;

class CourseStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:191',
            'time' => 'required',
            'sections' => 'required',
            'price' => 'nullable',
            'discount' => 'nullable',
            'level' => 'required',
            'short_description' => 'required|min:3|max:5000',
            'description' => 'required|min:3|max:100000',
            'properties' => 'nullable',
            'slug' => 'nullable',
            'image_alt'=> 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_robots' => 'nullable',
            'canonical_tag' => 'nullable',
            'professor_id' => 'required|exists:professors,id',
            'category_id' => 'required|exists:course_categories,id',
            'status' => 'required|boolean',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->has('status'),
            'meta_robots' => $this->has('meta_robots'),
            'price' => $this->filled('price') ? Helpers::removeComma($this->input('price')) : null,
            'discount' => $this->filled('discount') ? Helpers::removeComma($this->input('discount')) : null,
            'properties' => json_encode($this->properties),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
