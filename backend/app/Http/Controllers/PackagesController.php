<?php

namespace App\Http\Controllers;

use App\Notifications\SlackNotification;
use App\Model\Slack;
use Illuminate\Http\Request;
use App\Model\Package;
use App\Model\PaymentHistory;

class PackagesController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/packages/view",
     *     tags={"packages"},
     *     @OA\Response(response="200", description="Get all packages")
     * )
     */
    public function view()
    {
        $packages = Package::all();
        return $this->successApiResponse($packages);
    }


    public function getDeletedPackages()
    {
        return Package::onlyTrashed()->get();
    }

    /**
     * @OA\Get(
     *     path="/api/packages/get-package/{id}",
     *     tags={"packages"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Package ID",
     * ),
     *     @OA\Response(response="200", description="View a package")
     * )
     */

    public function getPackage($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }
        return $package;
    }


    public function create(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'name' => ['required'],
                'stripe_plan' => ['required'],
                'stripe_quantity' => ['required', 'numeric'],
                'daily_allowed' => ['required', 'numeric'],
                'weekly_allowed' => ['required', 'numeric'],
                'monthly_allowed' => ['required', 'numeric'],
                'boxfight_quantity' => ['required', 'numeric'],
                'pay' => ['required', 'numeric'],
            ]
        );

        $package = new Package($request->all());
        $package->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Package Created'
            ]
        );
    }

    public function update(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'name' => ['required'],
                'daily_allowed' => ['required', 'numeric'],
                'weekly_allowed' => ['required', 'numeric'],
                'monthly_allowed' => ['required', 'numeric'],
                'boxfight_quantity' => ['required', 'numeric'],
            ]
        );
        $package = Package::find($id);
        if (!$package) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }
        $package->name = $request->name;
        $package->boxfight_quantity = $request->boxfight_quantity;
        $package->daily_allowed = $request->daily_allowed;
        $package->weekly_allowed = $request->weekly_allowed;
        $package->monthly_allowed = $request->monthly_allowed;
        $package->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Package Updated'
            ]
        );
    }


    public function updateStripeComponents(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'stripe_plan' => ['required'],
                'stripe_quantity' => ['required', 'numeric'],
                'pay' => ['required', 'numeric'],
            ]
        );
        $package = Package::find($id);
        if (!$package) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }
        $package->stripe_plan = $request->stripe_plan;
        $package->stripe_quantity = $request->stripe_quantity;
        $package->pay = $request->pay;
        $package->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Package Stripe Components Updated'
            ]
        );
    }


    public function delete($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }
        $package->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Package Deleted'
            ]
        );
    }

/**
     * @OA\Get(
     *     path="/api/payment/payment-history/{id}",
     *     tags={"Payment-History"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User ID of Customer",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Get Users payment history")
     * )
     */

    public function getPaymentHistory($id)
    {
        $records = PaymentHistory::where('user_id', $id)->get();
        return $records;
    }
}
