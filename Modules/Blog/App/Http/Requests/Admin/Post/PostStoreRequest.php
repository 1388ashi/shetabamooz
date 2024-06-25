<?php

namespace Modules\Blog\App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'short_description' => 'required|min:3',
            'description' => 'required|min:3',
            'image' => 'required',
            'published_at' => 'required',
            'author' => 'nullable',
            'admin_id' => 'nullable',
            //'admin_id' => 'required',
            //status
            'status' => 'nullable|boolean',

            //view count
            //category is many-to-many relationship
            //seo
            'slug' => 'nullable',
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
            'status' => $this->has('status'),
            'published_at' => $this->published_at ?? now()->toDateTimeString(),
            'meta_robots' => $this->has('meta_robots'),
            'admin_id' => auth()->user()->id,
        ]);

        if ($this->slug){
            $this->merge([
                'slug' => str_replace(' ', '-', $this->slug),
            ]);
        }
    }


    public function authorize(): bool
    {
        return true;
    }
}
