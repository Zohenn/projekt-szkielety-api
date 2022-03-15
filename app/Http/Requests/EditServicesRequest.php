<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditServicesRequest extends FormRequest
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
            'assembly' => 'required|numeric|gt:0|max:9999',
            'os_installation' => 'required|numeric|gt:0|max:9999'
        ];
    }
}
