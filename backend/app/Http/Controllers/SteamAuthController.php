<?php

namespace App\Http\Controllers;

use App\Helpers\SteamID;
use App\Model\UserConnection;
use Invisnik\LaravelSteamAuth\SteamAuth;

/**
 * Test: https://dev.bangergames.com/api/steam/auth?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvZGV2LmJhbmdlcmdhbWVzLmNvbVwvYXBpXC9vYXV0aFwvY2FsbGJhY2siLCJpYXQiOjE2MDExMzUzMjUsImV4cCI6MTYwMTIyMTcyNSwibmJmIjoxNjAxMTM1MzI1LCJqdGkiOiI0WG9uR3B4YlF4aU5lMU1sIiwic3ViIjo3LCJwcnYiOiJmNmI3MTU0OWRiOGMyYzQyYjc1ODI3YWE0NGYwMmI3ZWU1MjlkMjRkIn0.IWA2bPLzGTOvsaJ7VyzOHT4zPFN6V3jdx8hV4E4jdeg
 * Class SteamAuthController
 * @package App\Http\Controllers
 */
class SteamAuthController extends Controller
{
    /**
     * The SteamAuth instance.
     *
     * @var SteamAuth
     */
    protected $steam;

    /**
     * The redirect URL.
     *
     * @var string
     */
    protected $redirectURL = '/';

    /**
     * AuthController constructor.
     *
     * @param SteamAuth $steam
     */
    public function __construct(SteamAuth $steam)
    {
        $this->steam = $steam;
    }

    /**
     * Redirect the user to the authentication page
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToSteam()
    {
        return $this->steam->redirect();
    }

    /**
     * Get user info and log in
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle()
    {
        if ($this->steam->validate()) {
            $info = $this->steam->getUserInfo();
            if (!is_null($info)) {
                try {
                    $steamID = new SteamID($info->steamID64);
                    $socialId = $steamID ? $steamID->RenderSteam2() : null;
                    if ($socialId) { // fix old steam IDS
                        $socialId = str_replace('STEAM_0', 'STEAM_1', $socialId);
                    }
                } catch( \InvalidArgumentException $e )
                {
                    $steamID = null;
                    $socialId = null;
                }
                $serviceInfo = [
                    'steamID64' => $info->steamID64,
                    'profilestate' => $info->profilestate,
                    'personaname' => $info->personaname,
                    'profileurl' => $info->profileurl,
                    'avatar' => $info->avatar,
                    'avatarmedium' => $info->avatarmedium,
                    'avatarfull' => $info->avatarfull,
                    'avatarhash' => $info->avatarhash,
                    'lastlogoff' => $info->lastlogoff,
                    'personastate' => $info->personastate,
                    'realname' => $info->realname,
                    'primaryclanid' => $info->primaryclanid,
                    'timecreated' => $info->timecreated,
                    'personastateflags' => $info->personastateflags,
                    'loccountrycode' => $info->loccountrycode,
                ];
                if ($userConnection = UserConnection::where('service_type', 'steam')
                    ->firstWhere('user_id', 7)
                ) {
                    $userConnection->update([
                        'data' => serialize($info),
                        'service_info' => $serviceInfo
                    ]);
                } else {
                    $userConnection = UserConnection::create([
                        'user_id' => 7,
                        'data' => serialize($info),
                        'service_type' => 'steam',
                        'social_id' => $socialId,
                        'service_info' => $serviceInfo
                    ]);

                }
//                var_dump($userConnection);die;

                return redirect($this->redirectURL); // redirect to site
            }
        }
        return $this->redirectToSteam();
    }

//    /**
//     * Getting user by info or created if not exists
//     *
//     * @param $info
//     * @return User
//     */
//    protected function findOrNewUser($info)
//    {
//        $user = User::where('steamid', $info->steamID64)->first();
//
//        if (!is_null($user)) {
//            return $user;
//        }
//
//        return User::create([
//            'username' => $info->personaname,
//            'avatar' => $info->avatarfull,
//            'steamid' => $info->steamID64
//        ]);
//    }
}
