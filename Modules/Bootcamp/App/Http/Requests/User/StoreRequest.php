<?php

namespace Modules\Bootcamp\App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Bootcamp\App\Models\BootcampUser;
use Modules\Core\Helpers\Helpers;

class 
StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:191',
            'mobile' => 'required|digits:11|regex:/(^09\d{9}$)/u',
            'bootcamp_id' => 'required|exists:bootcamps,id'
        ];
    }
    protected function passedValidation(): void
    {
        $user = BootcampUser::query()
        ->whereHas('bootcamps', function($query) {
            $query->where('bootcamps.id', $this->bootcamp_id);
        })
        ->where('bootcamp_users.mobile', $this->mobile)
        ->exists();
        if (!empty($user)) {
            throw Helpers::makeWebValidationException('شما قبلا در بوتکمپ ثبت نام کرده‌اید!');
        }
        
    }
    public function validated($key = null, $default = null) {
        $validated = parent::validated();
        $validated['status'] = 'new';
        unset(
            $validated['bootcamp_id'],
        );

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
