<?php

namespace Modules\Bootcamp\App\Http\Requests\Advisor;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'mobile' => 'required|digits:11',
            'type' => 'required',
            'time' => 'required',
        ];
    }
    public function validated($key = null, $default = null) {
        $validated = parent::validated();
        $validated['status'] = 'new';

        return $validated;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
