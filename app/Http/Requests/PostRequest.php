<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title'         => 'required|max:255|unique:posts',
            'description'   => 'required',
            'image'         => 'required|url'
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $post = $this->route()->parameter('post');

            $rules['title'] = [
                'required',
                'string',
                'max:255',
                Rule::unique('posts')->ignore($post),
            ];

            $rules['created_by'] = [];
        }

        return $rules;
    }
}
