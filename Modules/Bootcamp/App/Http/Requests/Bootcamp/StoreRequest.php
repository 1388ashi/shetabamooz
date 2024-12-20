<?php

namespace Modules\Bootcamp\App\Http\Requests\Bootcamp;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Helpers\Helpers;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:193',
            'subtitle' => 'required|max:193',
            'eventplace' => 'required|max:193',

            'image' => 'required',
            'video' => 'required',

            'professors.*' => 'required',
            'professors' => 'required|array',
            'professors.id' => 'integer|exists:professors,id',

            'time' => 'required|max:193',
            'fromhours' => 'required|max:193',
            'catering' => 'nullable|max:193',
            'published_at' => 'required|date',
            'price' => 'nullable',
            'discount' => 'nullable',
            'contacts' => 'required|max:193',
            'support' => 'nullable|max:193',
            'gifts' => 'nullable|max:193',
            'type' => 'required|max:193',
            'summary' => 'required|min:3|max:5000',
            'description' => 'required|min:3|max:100000',
            'prerequisite' => 'required|min:3|max:1000',
            'count_users' => 'required',
            'link_video' => 'nullable|string',
            'status' => 'nullable|boolean',
            'is_registers' => 'nullable|boolean',
            'its_over' => 'nullable|boolean',

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
            'its_over' => (bool) $this->input('its_over', 0),
            'is_registers' => (bool) $this->input('is_registers', 0),
            'meta_robots' => $this->has('meta_robots'),
            'price' => $this->filled('price') ? Helpers::removeComma($this->input('price')) : null,
            'discount' => $this->filled('discount') ? Helpers::removeComma($this->input('discount')) : null,
            'properties' => json_encode($this->properties),
        ]);
    }

    public function validated($key = null, $default = null) {
        $validated = parent::validated();
        unset(
            $validated['professors'],
            $validated['image'],
            $validated['video'],
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
