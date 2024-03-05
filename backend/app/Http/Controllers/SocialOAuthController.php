<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnectAccountRequest;
use App\Http\Requests\SocialOAuth\CallbackRequest;
use App\Http\Requests\SocialOAuth\CreateUserRequest;
use App\Service\SocialiteService;
use Exception;

class SocialOAuthController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/oauth/callback",
     *     tags={"Oauth"},
     * @OA\Parameter(
     *     name="token_aut",
     *     in="query",
     *     description="Token Auth",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="provider",
     *     in="query",
     *     description="Provider Name",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Get logged in users or token")
     * )
     */
    public function oAuthCallback(CallbackRequest $request)
    {
        $res = SocialiteService::oAuthCallback($request);
        if ($res['error'] ?? false) {
            return $this->internalErrorApiResponse($res['error']);
        }
        return response()->json($res);
    }

    /**
     * @OA\Post(
     *     path="/api/oauth/create-user",
     *     tags={"Oauth"},
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="Email",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="name",
     *     in="query",
     *     description="Name",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="social_id",
     *     in="query",
     *     description="Social id",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="image",
     *     in="query",
     *     description="Image Path",
     * ),
     * @OA\Response(response="200", description="Get logged in users in token")
     * )
     */
    public function createUser(CreateUserRequest $request)
    {
        try {
            $user = SocialiteService::createUser($request->all());
            return SocialiteService::returnAuthUser($user);
        } catch (Exception $e) {
            return $this->internalErrorApiResponse($e);
        }
    }

    public function connectAccount(ConnectAccountRequest $request)
    {
        $network = $request->input('network');

        if ($network === 'epicGames') {
            $res = SocialiteService::epicGamesAuth($request);
            return response()->json($res);
        } else {
            $res = SocialiteService::oAuthCallback($request);
            if ($res['error'] ?? false) {
                return $this->internalErrorApiResponse($res['error']);
            }
            return response()->json($res);
        }
    }
}
