<?php

namespace App\Http\Controllers;

use App\Service\DatHostService;
use Illuminate\Http\Request;

class DatHostController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/dathost/account-info",
     *     tags={"dathost"},
     * @OA\Parameter(
     *     name="username",
     *     in="query",
     *     description="Username",
     * ),
     * @OA\Parameter(
     *     name="password",
     *     in="query",
     *     description="Password",
     * ),
     *     @OA\Response(response="200", description="Get dathost account info")
     * )
     * @throws \Exception
     */
    public function getAccountInfo()
    {
        $datHostService = new DatHostService();
        $data = $datHostService->getAccountInfo();
        if (!empty($data)) {
            $data = json_decode($data);
        }
        return response()->json(
            $data
        );
    }

    public function getGameServers(Request $request)
    {
        $datHostService = new DatHostService();
        $data = $datHostService->getGameServers();
        if (!empty($data)) {
            $data = json_decode($data);
        }
        return response()->json(
            $data
        );
    }

    public function createGameServer(Request $request)
    {
        $datHostService = new DatHostService();
        $data = $datHostService->createGameServer();
        if (!empty($data)) {
            $data = json_decode($data);
        }
        return response()->json(
            $data
        );
    }

    public function startGameServer($id)
    {
        $datHostService = new DatHostService();
        $data = $datHostService->startGameServer($id);
        if (!empty($data)) {
            $data = json_decode($data);
        }
        return response()->json(
            $data
        );
    }

    public function stopGameServer($id)
    {
        $datHostService = new DatHostService();
        $data = $datHostService->stopGameServer($id);
        if (!empty($data)) {
            $data = json_decode($data);
        }
        return response()->json(
            $data
        );
    }

    public function deleteGameServer($id)
    {
        $datHostService = new DatHostService();
        $data = $datHostService->deleteGameServer($id);
        if (!empty($data)) {
            $data = json_decode($data);
        }
        return response()->json(
            $data
        );
    }
}
