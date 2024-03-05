<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
//            'account_number' => 'required',
//            'holder_name' => 'required',
//            'holder_type' => 'required',
//            'currency' => 'required',
//            'routing' => 'required',
            'destination' => 'required',
            'amount' => 'required',
        ];
    }
}
