<?php

namespace Modules\Request\App\Http\Requests\Admin\Consultation;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequestStore extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:191',
            'mobile' => 'required|regex:/(^09\d{9}$)/u',
            'text' => 'required|min:10',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
