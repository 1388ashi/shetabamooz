<?php

namespace Modules\Course\App\Http\Requests\Headline;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'course_id' => 'required|integer|exists:courses,id',
            'title' => [
                'required',
                'string',
            ],
            'order' => 'nullable',
            'description' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
