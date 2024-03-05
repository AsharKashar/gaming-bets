<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvidenceRequest extends FormRequest
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
        // todo change files type as you needed
        return [
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video'=>'required|mimes:video/mp4,video/3gpp,video/x-flv,video/x-msvideo,video/x-ms-wmv,video/MP2T,application/x-mpegURL',
        ];
    }



}
