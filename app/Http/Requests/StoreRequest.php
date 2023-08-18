<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('store');

        $rules = [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:15',
                Rule::unique('stores', 'name')->ignore($id),
            ],
            'description' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('stores', 'email')->ignore($id),
            ],
            'phone_number' => [
                'required',
                'numeric',
                Rule::unique('stores', 'phone_number')->ignore($id),
            ],
            'status' => 'required|in:active,inactive',
        ];

        if ($this->isMethod('post')) { // Store operation
            $rules['c_image'] = [
                'required','image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
            ];
            $rules['l_image'] = [
                'required','image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
            ];
        } elseif ($this->isMethod('put')) { // Update operation
            if ($this->has('c_image')) {
                $rules['c_image'] = [
                    'required','image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
                ];
            }
            if ($this->has('l_image')) {
                $rules['l_image'] = [
                    'required','image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
                ];
            }
        }
        return $rules;
    }
}
