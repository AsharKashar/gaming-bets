<?php

namespace App\Http\Controllers\Website;

use App\Service\AweberService;
use App\Model\Tournament;
use App\Model\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class AuthController extends Controller
{

    public function postRegister(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', "confirmed", 'string', 'min:3'],

            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $role = $data["role"] ?? 'user';

        try {
            $aweberService = new AweberService();
            $aweberService->subscribe(
                $data["email"],
                ['registered'],
                [
                    'role' => $role,
                    'username' => $data["name"],
                ]
            );
        } catch (ClientException $e) {
            return back()->with("msg", $e->getMessage());
        }


        $user = User::create(
            [
                "name" => $data["name"],
                "email" => $data["email"],
                "user_type" => $role,
                "password" => Hash::make($data["password"]),
                "currency_id" => isset($data["currency_id"]) ? $data["currency_id"] : null,
            ]
        );


        Auth::login($user);

        return back()->with("msg", "User Register Successfully");
    }


    public function postLogin(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $data,
            [
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:3'],
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                [
                    "status" => false,
                    'msg' => 'Data is missing.'
                ]
            );
        }
        $user = User::where("email", $request->email)->first();
        if ($user) {
            if (Hash::check(request()->get('password'), $user->password)) {
                (new AweberService())->subscribe(
                    $user->email,
                    ['login', 'registered'],
                    [
                        'role' => $user->user_type,
                        'username' => $user->name,
                    ]
                );
                Auth::login($user);
                return response()->json(
                    [
                        "status" => true
                    ]
                );
            } else {
                return response()->json(
                    [
                        "status" => false,
                        'msg' => 'Password is incorrect.'
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    "status" => false,
                    'msg' => 'Email not found'
                ]
            );
        }
    }

    public function postLogout()
    {
        auth()->logout();
        return redirect("/");
    }
}
