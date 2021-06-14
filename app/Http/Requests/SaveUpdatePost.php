<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUpdatePost extends FormRequest
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
        $id = $this->route()->parameter('id');

        $rules = [
            "title" => "required|unique:posts,title,".$id,
            "description" => "required",
            "image_path" => "required|image"
        ];

        if($this->method() == 'PUT')
            $rules['image_path'] = ['nullable', 'image'];

        return $rules;
    }
}
