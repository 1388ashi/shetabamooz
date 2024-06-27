<?php

namespace Modules\Bootcamp\App\Http\Requests\Headline;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'bootcamp_id' => 'required|integer|exists:bootcamps,id',
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
