<?php

namespace Modules\Course\App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;

class FaqStoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'question' => 'required|min:5',
            'answer' => 'nullable|min:5',
            'course_id' => 'required|exists:courses,id',
            'order' => 'nullable',
            'status' => 'required|boolean'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->has('status'),
        ]);
    }


    public function authorize(): bool
    {
        return true;
    }
}
