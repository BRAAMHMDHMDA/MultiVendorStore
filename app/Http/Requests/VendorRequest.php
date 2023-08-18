<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorRequest extends FormRequest
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
        $id = $this->route('vendor');

        $rules = [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:15',
                Rule::unique('vendors', 'name')->ignore($id),
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:15',
                Rule::unique('vendors', 'username')->ignore($id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('vendors', 'email')->ignore($id),
            ],
            'phone_number' => [
                'required',
                'numeric',
                Rule::unique('vendors', 'phone_number')->ignore($id),
            ],
            'store_id' => [
                'required', 'int', 'exists:stores,id'
            ],
            'image' => [
                'nullable','image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
            ],
            'status' => 'nullable|in:active,inactive',
        ];

        if ($this->isMethod('post')) { // Store operation
            $rules['password'] = 'required|string|min:6';
        } elseif ($this->isMethod('put')) { // Update operation
            if ($this->has('password')) {
                $rules['password'] = 'nullable|string|min:6';
            }
        }

        return $rules;
    }
}
