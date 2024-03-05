<?php

namespace App\Http\Requests\SocialOAuth;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'email' => 'string|required|email|unique:users',
            'social_id' => 'string|required',
            'image' => 'string'
        ];
    }
}
