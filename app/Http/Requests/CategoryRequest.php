<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('category');

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:15',
                Rule::unique('categories', 'name')->ignore($id),
            ],
            'parent_id' => [
                'nullable', 'int', 'exists:categories,id'
            ],
            'description' => [
                'required', 'min:10' , 'max:200'
            ],
            'image' => [
                'image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
            ],
            'status' => 'required|in:active,draft',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'This Category is Already Exists!',
        ];
    }
}
