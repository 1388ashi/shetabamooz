<?php

namespace Modules\Home\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentPovStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:1|max:191',
            'comment' => 'required|min:5|max:191',
            'image' => 'required',
            'status' => 'required|boolean'
        ];
    }

    public function prepareForValidation()
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
