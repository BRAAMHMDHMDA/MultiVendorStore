<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $id = $this->route('product');

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:20',
                Rule::unique('products', 'name')->ignore($id),
            ],
            'category_id' => 'required|int|exists:categories,id',
            'brand_id' => 'required|int|exists:brands,id',
            'description' => 'required',
            'image' => 'required|image|dimensions:min_width=150,min_height=150',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|int|min:0',
            'status' => 'in:' . Product::STATUS_ACTIVE . ',' . Product::STATUS_DRAFT. ',' . Product::STATUS_ARCHIVED,
        ];
    }
}
