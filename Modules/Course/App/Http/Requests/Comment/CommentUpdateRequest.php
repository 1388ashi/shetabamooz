<?php

namespace Modules\Course\App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'mobile' => 'nullable|regex:/(^09\d{9}$)/u',
            'text' => 'required|min:5',
            'course_id' => 'required',
            'parent_id' => 'nullable',
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
