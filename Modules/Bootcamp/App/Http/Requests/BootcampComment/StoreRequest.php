<?php

namespace Modules\Bootcamp\App\Http\Requests\BootcampComment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:191',
            'mobile' => 'required|digits:11|regex:/(^09\d{9}$)/u',
            'description' => 'required|min:3',
            'bootcamp_id' => 'required|exists:bootcamps,id',
            'status' => 'required'
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
