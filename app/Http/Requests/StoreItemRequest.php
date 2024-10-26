<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'item_code' => 'required|string|max:255|unique:items,item_code',
            'name' => 'required|string|max:255',
            'subcategory_id' => 'required|exists:subcategories,id',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required',
            'image' => 'nullable|image|max:2048'
        ];
    }
}
