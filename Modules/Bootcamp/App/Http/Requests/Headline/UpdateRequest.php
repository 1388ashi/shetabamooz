<?php

namespace Modules\Bootcamp\App\Http\Requests\Headline;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('headlines')->where(function (Builder $query) {
                    return $query->where('bootcamp_id', $this->input('bootcamp_id'));
                })->ignore($this->route('headline')->id)
            ]
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
