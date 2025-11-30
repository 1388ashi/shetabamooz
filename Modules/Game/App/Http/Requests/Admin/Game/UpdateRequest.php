<?php

namespace Modules\Game\App\Http\Requests\Admin\Game;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:193',
            'subtitle' => 'required|max:193',
            'eventplace' => 'required|max:193',
            'image' => 'nullable|image',

            'fromhours' => 'required|max:193',
            'catering' => 'nullable|max:193',
            'fromhours_num' => 'required|integer',
            'published_at' => 'required|date',
            'summary' => 'required|min:3|max:5000',
           
            'description' => 'required|min:3|max:100000',
            'prerequisite' => 'required|min:3|max:1000',
            'count_users' => 'required',
            'status' => 'nullable|boolean',
            'video_link' => 'nullable|string',
           
            'slug' => 'required',
            'image_alt'=> 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_robots' => 'nullable',
            'canonical_tag' => 'nullable',
        ];
    }

     protected function prepareForValidation()
    {
        $this->merge([
            'status' => (bool) $this->input('status', 0),
            'meta_robots' => $this->has('meta_robots'),
        ]);
    }

    public function validated($key = null, $default = null) {
        $validated = parent::validated();
        unset(
            $validated['image'],
        );

        return $validated;
    }
    public function authorize(): bool
    {
        return true;
    }
}
