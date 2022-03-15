<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveOrderRequest extends FormRequest
{
    protected $redirectRoute = 'cart.index';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() !== null && !$this->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|alpha_dash',
            'surname' => 'required|min:3|alpha_dash',
            'address' => 'required',
            'postal_code' => 'required|regex:/^[0-9]{2}-[0-9]{3}$/',
            'city' => 'required',
            'phone' => 'required|regex:/^[0-9]{9}$/',
            'payment_type_id' => 'required|exists:App\Models\PaymentType,id',
            'products' => 'required|array',
            'products.*' => 'exists:App\Models\Product,id',
        ];
    }

    public function messages() {
        return [
            'postal_code.regex' => 'Kod pocztowy musi być postaci 12-345',
            'phone.regex' => 'Numer telefonu musi się składać z 9 cyfr',
        ];
    }
}
