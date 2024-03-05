<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function users()
    {
        $users = User::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ],
            200
        );
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"user"},
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of pet that needs to be fetched",
     *     required=true,
     *   ),
     *     @OA\Response(response="200", description="Returns user data"),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'name' => $user->name
                ]
            ],
            200
        );
    }

    public function detail(Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'id' => ['required', 'numeric']
            ]
        );
        $user = User::find($request->id);

        return response()->json($user);
    }

    /**
     * @OA\Post(
     *     path="/api/user/edit/{id}",
     *     tags={"user"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User ID",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="name",
     *     in="query",
     *     description="name",
     * ),
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="email",
     * ),
     * @OA\Parameter(
     *     name="currency_id",
     *     in="query",
     *     description="currency_id",
     * ),
     * @OA\Parameter(
     *     name="username",
     *     in="query",
     *     description="username",
     * ),
     * @OA\Parameter(
     *     name="data_of_birth",
     *     in="query",
     *     description="data_of_birth dd/mm/YYYY",
     * ),
     *     @OA\Response(response="200", description="Edit user data")
     * )
     */
    public function userEdit(Request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'name' => ['string'],
                'email' => ['email'],
                'currency_id' => ['numeric'],
                'username' => ['string'],
                'data_of_birth' => ['date_format:d/m/Y'],
            ]
        );
        $user = User::find($id);

        foreach ($request->all() as $key => $value) {
            if ($key == 'password') {
                $value = Hash::make($value);
            }
            $user->{$key} = $value;
        }
        $user->save();

        return response()->json(['status' => 'success']);
    }

    /**
     * @OA\Post(
     *     path="/api/user/all",
     *     tags={"user"},
     *     @OA\Response(response="200", description="Get all user data")
     * )
     */
    public function all()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * @OA\Delete(
     *     path="/api/user/{id}",
     *     tags={"user"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Team token",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Edit user data")
     * )
     */
    public function delete($id)
    {

        $user = User::find($id);
        $user->delete();

        return response()->json(['status' => 'success']);
    }

    /**
     * @OA\Get(
     *     path="/api/auth/get-user-id",
     *     tags={"user"},
     *     @OA\Response(response="200", description="Get logged in users ID")
     * )
     */
    public function getUserId()
    {
        if (Auth::check()) {
            $id = Auth::id();
            return response()->json($id);
        }
        return response()->json(['error' => 'No user logged in.'], 400);
    }

}
