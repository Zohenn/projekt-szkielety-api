<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() !== null && $this->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'category_id' => 'required|exists:App\Models\Category,id',
            'price' => 'required|numeric|gt:0|max:999999',
            'amount' => 'required|numeric|gte:0',
            'description' => 'required',
            'image' => 'required|image|max:2048'
        ];
    }
}
