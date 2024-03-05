<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TournamentRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize () {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules () {
        return [
            "name"        => 'required',
            "game"        => 'required',
            "description" => 'nullable',
            "entry"       => 'required|numeric',
            "image"       => "nullable",
            "host"        => "required",
            "rules"       => "nullable",

            "first_prize"  => "nullable|numeric",
            "second_prize" => "nullable|numeric",
            "third_prize"  => "nullable|numeric",

            "first_points"  => "nullable|numeric",
            "second_points" => "nullable|numeric",
            "third_points"  => "nullable|numeric",

            "match_set"    => "required",
            "team_size"    => "nullable",
            "regions"      => "required",
            "match_type"   => "required",
            "game_type"    => "required",
            "game_mode"    => "required",
            "start_at"     => "required",
            "end_at"       => "required",
            "position"     => 'nullable',
            "position.*.prize"   => "nullable|numeric",
            "position.*.point"   => "nullable|numeric",
        ];
    }


}
