<?php

namespace Modules\Professor\App\Http\Requests\Admin\Professor;

use Illuminate\Foundation\Http\FormRequest;

class ProfessorStoreRequest extends FormRequest
{

    public function rules(): array
    {

        return [
            'name' => 'required|min:3|max:191',
            'description' => 'nullable|min:3|max:10000',
            'image' => 'required',
            'status' => 'required|boolean',
            'role' => 'required|min:3|max:191',
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
