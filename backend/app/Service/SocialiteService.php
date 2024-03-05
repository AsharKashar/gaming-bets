<?php


namespace App\Service;


use App\Http\Requests\ConnectAccountRequest;
use App\Http\Requests\SocialOAuth\CallbackRequest;
use App\Model\User;
use App\Model\UserConnection;
use App\Service\AweberService;
use Exception as ExceptionAlias;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse as JsonResponseAlias;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use JWTAuth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;


class SocialiteService
{
    /**
     * @param  User  $user
     * @return array
     */
    public static function returnAuthUser(User $user) {
        $token = JWTAuth::fromUser($user);
        return ['user' =>  $user, 'token' => $token];
    }

    /**
     * @param int $socialId
     * @param  int $userId
     */
    public static function updateOrCreateSocial($userId, $serviceInfo=[]) {
        UserConnection::updateOrCreate([
            'service_type' => $serviceInfo['service_type'],
            'user_id' => $userId,
            'service_info' => ['token' => $serviceInfo['token']],
            'social_id' => $serviceInfo['social_id']
        ]);
    }

    /**
     * @param  array  $userData
     * @return JsonResponseAlias|void
     */
    public static function useAweberSubscribe(array $userData) {
        try {
            (new AweberService())->subscribe($userData['email'], ['registered'], [
                'role' => 'user',
                'username' => $userData['name'],
            ]);
        } catch (ClientException $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'type' => 'aweber',
                ],
                422
            );
        }
    }

    /**
     * @param  array  $userData
     * @return User|Model
     * @throws ExceptionAlias
     */
    public static function createUser (array $userData) {
        self::useAweberSubscribe($userData);
        $stripeCustomer = StripeService::createCustomer($userData['name'], $userData['email']);

        $user = User::create([
            'email' => $userData['email'],
            'name' => $userData['name'],
            'image' => $userData['image'],
            'password' =>  Hash::make(random_bytes(8)),
            'user_type' => 'user',
            'stripe_id' => $stripeCustomer->id,
            'boxfights_allowed' => 10,
            'boxfights_renew' => Carbon::now(),
        ]);
       self::updateOrCreateSocial($user->id, $userData);
        return $user;
    }


    public static function checkFields (User $user) {
        if (!$user->stripe_id) {
            $stripeCustomer = StripeService::createCustomer($user['name'], $user['email']);
            $user->stripe_id = $stripeCustomer->id;
            $user->save();
        }
        if (!$user->boxfights_renew) {
            $user->boxfights_allowed = 10;
            $user->boxfights_renew = Carbon::now();
            $user->save();
        }
    }


    /**
     * @param  CallbackRequest  $request
     * @return array|ExceptionAlias[]|\Laravel\Socialite\Two\User[]
     */
    public static function oAuthCallback(CallbackRequest $request)
    {
        try {
            $serviceType = $request->provider;
            $tokenUser = Socialite::driver($serviceType)->userFromToken($request->token_aut);
            $socialId = $tokenUser->id;
            $socialUser = UserConnection::where('service_type', $serviceType)->where('social_id',$socialId)->first();
            $tokenEmail = optional($tokenUser)->email;
            $userData = json_decode(json_encode($socialUser), true);
            $userData['social_id'] = $socialId;
            $userData['service_type'] = $serviceType;
            $userData['name'] = $tokenUser->name;
            $userData['image'] = $tokenUser->avatar_original ?? $tokenUser->avatar;
            $userData['token'] = $tokenUser->token;

            if (!$socialUser) {
                if(!$tokenEmail) {
                    return ['user' => $userData];
                }
                $userData['email'] = $tokenEmail;
                $user = User::firstWhere('email', $tokenEmail);
               if ($user) {
                   //$user->update($userData);
                   self::useAweberSubscribe($userData);
                   self::updateOrCreateSocial($user->id, $userData);
                   self::checkFields($user);
                   return self::returnAuthUser($user);
               }
            }

            $user = $socialUser ? $socialUser->user : self::createUser($userData);
            self::checkFields($user);

            return self::returnAuthUser($user);
        } catch (ExceptionAlias $e) {
            return ['error' => $e];
        }
    }


    public static function epicGamesAuth(ConnectAccountRequest $request)
    {
        $response = Http::withBasicAuth(
            config('services.epic_game.client_id'),
            config('services.epic_game.client_secret')
        )
        ->asForm()
        ->post(
            config('services.epic_game.redirect'), [
                'grant_type' => 'authorization_code',
                'code' => $request->input('code'),
                'scope' => 'basic_profile'
            ]
        );

        if ($response->successful()) {
            $content = json_decode($response->getBody()->getContents(), true);
            $request->user()->updateConnection(UserConnection::$serviceTypes['EPIC_GAMES'], $content);
        }
    }
}
