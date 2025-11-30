<?php

namespace Modules\Game\App\Http\Requests\Front\User;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Game\App\Models\GameUser;
use Modules\Core\Helpers\Helpers;

class StoreRequest extends FormRequest
{
 public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:191',
            'mobile' => 'required|digits:11|regex:/(^09\d{9}$)/u',
            'game_id' => 'required|exists:games,id',
        ];
    }
    protected function passedValidation(): void
    {
        $user = GameUser::query()
        ->whereHas('games', function($query) {
            $query->where('games.id', $this->game_id);
        })
        ->where('game_users.mobile', $this->mobile)
        ->exists();
        if (!empty($user)) {
            throw Helpers::makeWebValidationException('شما قبلا در بوتکمپ ثبت نام کرده‌اید!');
        }
        
    }
    public function validated($key = null, $default = null) {
        $validated = parent::validated();
        $validated['status'] = 'new';
        unset(
            $validated['game_id'],
        );

        return $validated;
    }
    public function authorize(): bool
    {
        return true;
    }
}
