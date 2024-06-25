<?php

namespace Modules\Request\App\Http\Requests\Admin\Cooperation;

use Illuminate\Foundation\Http\FormRequest;

class CooperationRequestStore extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:191',
            'mobile' => 'required|unique:students|regex:/(^09\d{9}$)/u',
            'resume' => 'required|min:10',
            'email' => 'nullable|email',
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
