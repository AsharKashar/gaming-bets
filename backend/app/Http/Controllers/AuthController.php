<?php

namespace App\Http\Controllers;

use App\Service\AweberService;
use App\Model\User;
use App\Service\StripeService;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;
use JWTAuth;


class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     tags={"auth"},
     * @OA\Parameter(
     *     name="name",
     *     in="query",
     *     description="Name",
     *     required=true,
     * ),
     * * @OA\Parameter(
     *     name="username",
     *     in="query",
     *     description="Username",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="Email",
     *      required=true,
     * ),
     * @OA\Parameter(
     *     name="password",
     *     in="query",
     *     description="Password",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="password_confirmation",
     *     in="query",
     *     description="Password confirmation",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="country_id",
     *     in="query",
     *     description="ID of the country",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="gender",
     *     in="query",
     *     description="Gender of the user",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="date_of_birth",
     *     in="query",
     *     description="Starting Date in timestamp format d/m/Y",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Register a new user")
     * )
     * @throws \Exception
     */
    public function register(Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:3|confirmed',
                'username' => 'required',
                'country_id' => 'required|exists:countries,id',
                'gender' => 'required|in:'. implode(',', User::GENDER),
                'date_of_birth' => 'required|date_format:d/m/Y|before:13 years ago|after:80 years ago'
            ]
        );
        if ($v->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'errors' => $v->errors()
                ],
                422
            );
        }

//        try {
//            (new AweberService())->subscribe(
//                $request->email,
//                ['registered'],
//                [
//                    'role' => $request->role,
//                    'username' => $request->name,
//                ]
//            );
//        } catch (ClientException $e) {
//            return response()->json(
//                [
//                    'error' => $e->getMessage(),
//                    'type' => 'aweber',
//                ],
//                422
//            );
//        }

        $stripeCustomer = StripeService::createCustomer($request->name, $request->email);

        if (!isset($stripeCustomer->id)) {
            return $this->internalErrorApiResponse([], $stripeCustomer->getMessage());
        }

        $user = User::registerNewUser([
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'username' => $request->username,
            'country_id' => $request->country_id,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'stripe_customer_id' => $stripeCustomer->id,
        ]);

        return response()->json(
            [
                'status' => 'success',
                'access_token' => JWTAuth::fromUser($user)
            ],
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"auth"},
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="Email",
     * ),
     * @OA\Parameter(
     *     name="password",
     *     in="query",
     *     description="Password",
     * ),
     *     @OA\Response(response="200", description="Login a user")
     * )
     * @throws \Exception
     */
    public function login(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $request->email, 'password' => $request->password];
        } else {
            $credentials = ['username' => $request->email, 'password' => $request->password];
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials'], 400);
            }
            auth()->attempt($credentials);
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        try {
            // todo: WIP, find user by token
//            (new AweberService())->subscribe($request->email, ['login', 'registered'], [
//                'role' => $request->user_type,
//                'username' => $request->name,
//            ]);
        } catch (ClientException $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'type' => 'aweber',
                ],
                422
            );
        }

        return response()->json(
            [
                'access_token' => $token
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/api/auth/check",
     *     tags={"auth"},
     * @OA\Parameter(
     *     name="token",
     *     in="query",
     *     description="Token",
     * ),
     *     @OA\Response(response="200", description="Returns user is authenticated or not"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function check()
    {
        if (Auth::check()) {
            return response()->json(['authenticated' => true], 200);
        }

        return response()->json(['authenticated' => false], 401);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"auth"},
     * @OA\Parameter(
     *     name="token",
     *     in="query",
     *     description="Token",
     * ),
     *     @OA\Response(response="200", description="Logout user"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json(
            [
                'status' => 'success',
                'msg' => 'Logged out Successfully.'
            ],
            200
        );
    }

    /**
     * @OA\Get(
     *     path="/api/auth/me",
     *     tags={"auth"},
     * @OA\Parameter(
     *     name="token",
     *     in="query",
     *     description="Token",
     * ),
     *     @OA\Response(response="200", description="Returns user data"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function me()
    {
        if (!auth()->check()) {
            return response()->json(
                [
                    'error' => 'not_logged_in',
                ]
            );
        }
        return response()->json(
            [
                'status' => 'success',
                'data' => auth()->user()->makeVisible('all_bombs')
            ]
        );
    }

    private function guard()
    {
        return auth()->guard();
    }
}
