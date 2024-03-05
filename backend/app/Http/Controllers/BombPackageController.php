<?php

namespace App\Http\Controllers;

use App\Model\BombPackage;
use Illuminate\Http\Request;

class BombPackageController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api/bomb-package/get-packages",
     *     tags={"Bomb-Package"},
     *     @OA\Response(response="200", description="Get all bomb packages")
     * )
     */
    public function getPackages()
    {
        $bombPackages = BombPackage::all();
        return $this->successApiResponse($bombPackages);
    }


    public function deletePackage($id)
    {
        $data = BombPackage::find($id);
        $data->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Package Deleted',
            ]
        );
    }


    public function insertPackage(request $request)
    {
        $data = new BombPackage();
        $data->bombs = $request->bombs;
        $data->free_bombs = $request->free_bombs;
        $data->price = $request->price;
        $data->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Package created',
            ]
        );
    }


    public function updatePackage(Request $request, $id)
    {
        $data = BombPackage::find($id);
        $data->bombs = $request->bombs;
        $data->free_bombs = $request->free_bombs;
        $data->price = $request->price;
        $data->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Package Updated',
            ]
        );
    }


    /**
     * @OA\Get(
     *     path="/api/bomb-package/get-package/{id}",
     *     tags={"Bomb-Package"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of Bomb package",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Get bombs Package")
     * )
     */

    public function getPackage($id)
    {
        $data = BombPackage::getPackage($id);
        if (!$data) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }
        return response()->json($data);
    }
}
