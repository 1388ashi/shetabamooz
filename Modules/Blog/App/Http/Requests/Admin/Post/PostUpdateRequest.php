<?php

namespace Modules\Blog\App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'short_description' => 'required|min:3',
            'description' => 'required|min:3',
            'author' => 'nullable',
            'status' => 'nullable|boolean',

//            'image' => 'required',
            'published_at' => 'nullable',
            'admin_id' => 'required',
            //status
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
            'admin_id' => auth()->user()->id,
            //published_at => in controller
            'meta_robots' => $this->has('meta_robots'),
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
