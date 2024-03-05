<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card_no' => 'required|numeric|regex:/[0-9]{14,16}/i',
            'cvv_number' => 'required|numeric|digits_between:3,4',
            'exp_month' => 'required|date_format:"m"',
            'exp_year' => 'required|date_format:"Y"',
        ];
    }
}
