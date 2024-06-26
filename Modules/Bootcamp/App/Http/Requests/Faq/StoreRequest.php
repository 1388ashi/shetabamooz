<?php

namespace Modules\Bootcamp\App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'question' => 'required|min:5',
            'answer' => 'nullable|min:5',
            'bootcamp_id' => 'required|exists:bootcamps,id',
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
