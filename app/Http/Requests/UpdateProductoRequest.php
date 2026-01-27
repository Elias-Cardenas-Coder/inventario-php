<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductoRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('productos', 'name')->ignore($this->producto),
            ],
            'description' => 'nullable|string|max:1000',
            'category' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'sku' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('productos', 'sku')->ignore($this->producto),
            ],
            'active' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es requerido.',
            'name.unique' => 'Ya existe un producto con ese nombre.',
            'price.required' => 'El precio es requerido.',
            'price.min' => 'El precio debe ser mayor a 0.',
            'stock.required' => 'El stock es requerido.',
            'stock.min' => 'El stock no puede ser negativo.',
        ];
    }
}
