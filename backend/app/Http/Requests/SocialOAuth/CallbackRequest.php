<?php

namespace App\Http\Requests\SocialOAuth;

use Illuminate\Foundation\Http\FormRequest;

class CallbackRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token_aut' => 'string|required',
            'provider' => 'string|required'
        ];
    }
}
