<?php

namespace Modules\Admin\App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Rules\IranMobile;

class AdminStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'mobile' => ['required', new IranMobile(), Rule::unique('admins')],
            'email' => 'nullable|email|max:191',
            'password' => 'required|string|max:50|confirmed',
            'status' => 'required|boolean',
            'permissions' => 'nullable|array',
            'permissions.*' => 'required|string|exists:permissions,name'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->has('status')
        ]);
    }

    protected function passedValidation()
    {
        $this->merge([
            'password' => bcrypt($this->input('password'))
        ]);
    }
}
