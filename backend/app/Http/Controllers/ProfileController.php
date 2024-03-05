<?php

namespace App\Http\Controllers;

use App\Model\Card;
use App\Model\PaymentHistory;
use App\Model\User;
use App\Service\S3Service;
use App\UserPoint;
use App\Model\Withdrawal;
use App\Model\UserGameStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/profile/changePassword",
     *     tags={"profile"},
     * @OA\Parameter(
     *     name="id",
     *     in="query",
     *     description="id",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="currentPassword",
     *     in="query",
     *     description="Current Password",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="newPassword",
     *     in="query",
     *     description="New Password",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="confirmPassword",
     *     in="query",
     *     description="Confirm Password",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Change Password")
     * )
     */
    public function changePassword(Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'id' => ['required', 'numeric'],
                'currentPassword' => ['string'],
                'newPassword' => ['string'],
                'confirmPassword' => ['string'],
            ]
        );
        $user = User::find($request->id);

        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json(['error' => 'Current Password Error'], 200);
        }
        if ($request->newPassword !== $request->confirmPassword) {
            return response()->json(['error' => 'New Password not confirmed !'], 400);
        }
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json(['status' => 'success', 'message' => 'Your password has been changed.']);
    }

    /**
     * @OA\Post(
     *     path="/api/profile/getMe",
     *     tags={"profile"},
     *     @OA\Response(response="200", description="Get User Details")
     * )
     */
    public function getMe(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(
                [
                    'error' => 'not_logged_in',
                ],
                403
            );
        }
        $user = User::find(Auth::user()->id);
        return response()->json(
            [
                'status' => 'success',
                'data' => $user
            ]
        );
    }

    /**
     * @OA\Post(
     *     path="/api/profile/updateProfile",
     *     tags={"profile"},
     * @OA\Parameter(
     *     name="id",
     *     in="query",
     *     description="User id",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="name",
     *     in="query",
     *     description="Name",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="Email",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Update Profile")
     * )
     */
    public function updateProfile(Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'id' => ['required', 'numeric'],
                'name' => ['string'],
                'email' => ['email'],
            ]
        );
        $user = User::find($request->id);

        foreach ($request->all() as $key => $value) {
            $user->{$key} = $value;
        }
        $user->save();

        return response()->json(['status' => 'success', 'message' => 'Your profile has been updated.']);
    }

    /**
     * @OA\Post(
     *     path="/api/profile/getStats",
     *     tags={"profile"},
     * @OA\Parameter(
     *     name="id",
     *     in="query",
     *     description="User Id",
     *     required=true,
     * ),
     *
     *     @OA\Response(response="200", description="Get Profile Stats")
     * )
     */
    public function getStats(Request $request)
    {
        $totalPoints = UserPoint::where('user_id', $request->id)->sum('points');
        $winRecord = 0;

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'totalPoints' => $totalPoints,
                    'totalBombs' => "todo show user's coins",
                    'winRecord' => $winRecord,
                ]
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/api/profile/payment/history",
     *     tags={"profile"},
     *     @OA\Response(response="200", description="Get Profile Payment History List")
     * )
     */
    public function getPaymentHistory()
    {
        $history = PaymentHistory::where('user_id', Auth::user()->id)->get();
        return response()->json(
            [
                'status' => 'success',
                'data' => $history
            ]
        );
    }

    /**
     * @OA\Post(
     *     path="/api/profile/updateAvatar",
     *     tags={"profile"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             description="Profile Avatar",
     *                             property="avatar",
     *                             type="string", format="binary"
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Update Profile Avatar")
     * )
     */
    public function updateAvatar(Request $request)
    {
        $avatar = $request->file('avatar');
        if ($avatar) {
            $path = S3Service::uploadToDirectory($avatar, "teams/".Auth::user()->id."");
            $user = User::find(Auth::user()->id);
            $user->image = $path;
            $user->save();
        }
    }

    /**
     * @OA\Post(
     *     path="/api/profile/withdrawal",
     *     tags={"profile"},
     * @OA\Parameter(
     *     name="account_number",
     *     in="query",
     *     description="Account Number",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="account_holdername",
     *     in="query",
     *     description="Account Holder Name",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="bank_name",
     *     in="query",
     *     description="Bank name",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="last4",
     *     in="query",
     *     description="Card Last4 Number",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="account_holdertype",
     *     in="query",
     *     description="Account Holder Type",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="currency",
     *     in="query",
     *     description="Currency",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="routing_number",
     *     in="query",
     *     description="Routing Number",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Profile Save Withdrawal")
     * )
     */
    public function saveWithdrawal(Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'account_number' => ['required', 'numeric'],
                'account_holdername' => ['required', 'string'],
                'bank_name' => ['required', 'string'],
                'last4' => ['required', 'numeric'],
                'account_holdertype' => ['required', 'string'],
                'currency' => ['required', 'string'],
                'routing_number' => ['required', 'numeric'],
            ]
        );

        $save = Withdrawal::addWithdrawal($request->all());
        if ($save) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error']);
    }

    /**
     * @OA\Get(
     *     path="/api/profile/getWithdrawal",
     *     tags={"profile"},
     *     @OA\Response(response="200", description="Get Profile Withdrawal List")
     * )
     */
    public function getWithdrawal()
    {
        $withdrawal = Withdrawal::where('user_id', Auth::user()->id)->get();
        return response()->json(
            [
                'status' => 'success',
                'data' => $withdrawal
            ]
        );
    }

    public function getStatistic(Request $request)
    {
        if (empty($request->game_id)) {
            $request->game_id = 1;
        }
        return UserGameStatistic::getStatistic(Auth::user()->id, $request->game_id);
    }

    /**
     * @OA\Get(
     *     path="/api/profile/payment/cards",
     *     tags={"profile"},
     *     @OA\Response(response="200", description="Get user's saved cards"),
     *     security={
     *         {"query_token": {}}
     *     }
     * )
     */
    public function getPaymentsMethods(){
        $cards = Card::where('user_id',Auth::user()->id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $cards
        ]);
    }
}
