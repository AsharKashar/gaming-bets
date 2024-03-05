<?php

namespace App\Http\Controllers;

use App\Notifications\SlackNotification;
use App\Model\Slack;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\PaymentHistory;
use App\Model\Membership;
use App\Model\User;
use App\Model\Card;
use App\Model\Package;

class MembershipController extends Controller
{//
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    }


    /**
     * @OA\Post(
     *     path="/api/membership/create-membership-subscription",
     *     tags={"membership"},
     * @OA\Parameter(
     *     name="id",
     *     in="query",
     *     description="User ID of the User",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="package_id",
     *     in="query",
     *     description="Package ID from the packages table",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="cardID",
     *     in="query",
     *     description="ID of the card you want to use for subscription, it will also become default payment method",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Create stripe subscription and add Membership Record for the User ( Using Existing Payment Method )")
     * )
     */
    public function addMembershipRecord(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'id' => ['required', 'numeric'],
                'package_id' => ['required', 'numeric'],
                'cardID' => ['required', 'numeric'],
            ]
        );

        $user = User::find($request->id);
        if (!$user) {
            return response()->json(
                [
                    'message' => 'User not found'
                ],
                400
            );
        }

        $packageDetails = Package::getPackage($request->package_id);
        if (!$packageDetails) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }

        $quantity = Package::getQuantityOfPackage($request->package_id);
        if (!$quantity) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }

        $exists = Membership::checkIfMembershipExists($request->id);
        if ($exists) {
            return response()->json(['error' => 'Already Subsribed to a package.'], 400);
        }

        $stripe = User::getUserStripeId($request->id);
        if (!$stripe) {
            return response()->json(['error' => 'No stripe ID found for this cusstomer.'], 400);
        }
        $paymentID = Card::getPaymentMethod($request->cardID);
        if (!$paymentID) {
            return response()->json(['error' => 'Invalid Card ID.'], 400);
        }
        $ret = Card::makeDefaultMethodForUser($stripe, $paymentID->stripe_payment_method);
        if (!$ret) {
            return response()->json(['error' => 'Some error occured with stripe payment.'], 400);
        }
        if ($ret['error']) {
            return response()->json(['error' => $ret['error']], 400);
        }

        $subscription_id = $this->createSubscription($quantity, $request->id);
        if (!$subscription_id) {
            return response()->json(['error' => 'Subscription error.'], 400);
        }

        $user = User::find($request->id);
        if (!$user) {
            return response()->json(
                [
                    'message' => 'User not found'
                ],
                400
            );
        }
        $currentTime = Carbon::now();

        $paymentHistory = new PaymentHistory();
        $paymentHistory->user_id = $request->id;
        $paymentHistory->pay = $packageDetails->pay;
        $paymentHistory->save();

        $membership = new Membership();
        $membership->stripe_id = $stripe;
        $membership->user_id = $request->id;
        $membership->sub_id = $subscription_id;
        $membership->sub_update_date = $currentTime;
        $membership->daily_date = $currentTime;
        $membership->weekly_date = $currentTime;
        $membership->monthly_date = $currentTime;
        $membership->membership_quantity = $quantity;
        $membership->permission = 1;
        $membership->name = $packageDetails->name;
        $membership->package_id = $packageDetails->id;
        $membership->boxfight_quantity = $packageDetails->boxfight_quantity;
        $membership->daily_quantity = 1;
        $membership->daily_allowed = $packageDetails->daily_allowed;
        $membership->weekly_quantity = 1;
        $membership->weekly_allowed = $packageDetails->weekly_allowed;
        $membership->monthly_quantity = 1;
        $membership->monthly_allowed = $packageDetails->monthly_allowed;
        $membership->pay = $packageDetails->pay;
        $membership->save();

        \Notification::send(
            new Slack(),
            new SlackNotification(
                $user,
                $paymentID,
                $packageDetails,
                'new',
            )
        );

        return response()->json(
            [
                'success' => true,
                'message' => 'Subscribed to the Package'
            ]
        );
    }


    public function createSubscription($quantity, $id)
    {
        $stripe = User::getUserStripeId($id);

        $plan = Package::getPlanName($quantity);
        if (!$plan) {
            return false;
        }


        $error = 0;
        try {
            // Use Stripe's library to make requests...
            $sub_return = \Stripe\Subscription::create(
                [
                    "customer" => $stripe,
                    "items" => [
                        [
                            "plan" => $plan,
                            "quantity" => $quantity,
                        ],
                    ],
                ]
            );
        } catch (\Stripe\Exception\CardException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $error = $e->getError()->message;
        } catch (Exception $e) {
            $error = $e->getError()->message;
        }
        if ($error) {
            return response()->json(
                [
                    'message' => $error
                ],
                400
            );
        }
        return $sub_return->id;
    }


    /**
     * @OA\Post(
     *     path="/api/membership/create-membership-subscription-using-token",
     *     tags={"membership"},
     * @OA\Parameter(
     *     name="id",
     *     in="query",
     *     description="User ID of the User",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="package_id",
     *     in="query",
     *     description="Package ID from the packages table",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="tokenId",
     *     in="query",
     *     description="Card Token generated by Stripe Card Element",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="name",
     *     in="query",
     *     description="Name of the card holder",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Create stripe subscription and add Membership Record for the User ( Using stripe token )")
     * )
     */

    public function createTokenMembership(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'id' => ['required', 'numeric'],
                'tokenId' => ['required'],
                'name' => ['required'],
                'package_id' => ['required', 'numeric'],
            ]
        );
        $name = [];
        $stripe_id = User::getUserStripeId($request->id);

        $paymentMethod = Card::createPaymentMethod($request->tokenId);
        if ($paymentMethod['error']) {
            return response()->json(
                [
                    'message' => $paymentMethod['error']
                ],
                400
            );
        }
        $ret = Card::attachPaymentMethod($paymentMethod, $stripe_id);
        if ($ret) {
            return response()->json(
                [
                    'message' => $ret,
                ],
                400
            );
        }

        $name = $request->first_name;
        $card = Card::addPaymentMethodDB($paymentMethod, $request->id, $name);
        $request['cardID'] = $card->id;
        return $this->addMembershipRecord($request);
    }


    /**
     * @OA\Delete(
     *     path="/api/membership/cancel-subscription/{id}",
     *     tags={"membership"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User ID of Customer",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Delete Subscription on stripe")
     * )
     */
    public function cancelSubscription($id)
    {
        $stripe = Membership::getUserSubscriptionId($id);
        if (!$stripe) {
            return response()->json(
                ['error' => 'No Subscription ID found for this customer. Membership does not exist'],
                400
            );
        }
        $error1 = 0;
        try {
            // Use Stripe's library to make requests...
            $invoice = new \Stripe\StripeClient(
                config('services.stripe.secret')
              );
              $invoice->subscriptions->retrieve(
                $stripe->sub_id,
                []
              );
        } catch (\Stripe\Exception\CardException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $error = $e->getError()->message;
        } catch (Exception $e) {
            $error = $e->getError()->message;
        }
        if ($error1) {
            return response()->json(
                [
                    'message' => $error
                ],
                400
            );
        }
        $error = 0;
        try {
            // Use Stripe's library to make requests...
            // $sub = \Stripe\Subscription::retrieve($stripe->sub_id);
            // $sub->cancel();
            $sub = new \Stripe\StripeClient(
                config('services.stripe.secret')
              );
              $invoice =  $sub->subscriptions->update(
                $stripe->sub_id,
                [
                    'cancel_at_period_end' => true,

                ]
              );
        } catch (\Stripe\Exception\CardException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $error = $e->getError()->message;
        } catch (Exception $e) {
            $error = $e->getError()->message;
        }
        if ($error) {
            return response()->json(
                [
                    'message' => $error
                ],
                400
            );
        }

        // $ret = Membership::deleteRecord($id);
        // if ($ret) {
            \Notification::send(
                new Slack(),
                new SlackNotification(
                    User::find($id),
                    null,
                    $stripe,
                    'cancel',
                )
            );
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Membership Cancelled',
                    'expiry_date' =>  date('d-m-Y H:i A', $invoice->current_period_end),
                ]
            );
        // }
    }


    /**
     * @OA\Post(
     *     path="/api/membership/get-invoice-package-change/{id}",
     *     tags={"membership"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User ID of Customer",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="package_id",
     *     in="query",
     *     description="Package ID from the packages table",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Get Invoice of amount user will pay for remaining month if package upgraded or degraded")
     * )
     */

    public function retrieveInvoiceForRemainingMonth(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'package_id' => ['required', 'numeric'],
            ]
        );

        $stripe = User::getUserStripeId($id);
        $stripe_sub = Membership::getUserSubscriptionId($id);
        $quantity = Package::getQuantityOfPackage($request->package_id);
        if (!$quantity) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }
        $proration_date = time();

        $error = 0;
        try {
            // Use Stripe's library to make requests...
            $subscription = \Stripe\Subscription::retrieve($stripe_sub->sub_id);
            $items = [
                [
                    'id' => $subscription->items->data[0]->id,
                    'quantity' => $quantity, # Switch to new plan
                ],
            ];


            $invoice = \Stripe\Invoice::upcoming(
                [
                    "customer" => $stripe,
                    "subscription" => $stripe_sub->sub_id,
                    "subscription_items" => $items,
                    'subscription_proration_date' => $proration_date,
                ]
            );
        } catch (\Stripe\Exception\CardException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $error = $e->getError()->message;
        } catch (Exception $e) {
            $error = $e->getError()->message;
        }
        if ($error) {
            return response()->json(
                [
                    'message' => $error
                ],
                400
            );
        }


        $cost = 0;
        $current_prorations = [];
        foreach ($invoice->lines->data as $line) {
            if ($line->period->start - $proration_date <= 1) {
                array_push($current_prorations, $line);
                $cost += $line->amount;
            }
        }
        if ($current_prorations) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'There will be upgradation charges',
                    'charges' => $cost / 100,
                ]
            );
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Value Remained same'
            ]
        );
    }


    /**
     * @OA\Post(
     *     path="/api/membership/update-membership/{id}",
     *     tags={"membership"},
     * * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User ID of Customer",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="package_id",
     *     in="query",
     *     description="Package ID from the packages table",
     *     required=true,
     * ),
     * @OA\Parameter(
     *     name="cardID",
     *     in="query",
     *     description="ID of the card you want to use for subscription, it will also become default payment method",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Update Membership Record for user")
     * )
     */
    public function updateMembershipRecord(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'package_id' => ['required', 'numeric'],
                'cardID' => ['required', 'numeric'],
            ]
        );

        $quantity = Package::getQuantityOfPackage($request->package_id);
        if (!$quantity) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }

        $exists = Membership::checkIfMembershipExists($request->id);
        if (!$exists) {
            return response()->json(['error' => 'User isnt subscribed to any package.'], 400);
        }

        if ($exists->membership_quantity == $quantity) {
            return response()->json(['error' => 'Already subscribed to this package.'], 400);
        }

        $stripe_sub = $this->update($quantity, $id, $request->cardID);
        if (!$stripe_sub) {
            return response()->json(['error' => 'Subscription error.'], 400);
        }

        $packageDetails = Package::getPackage($request->package_id);
        if (!$packageDetails) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }
        $paymentHistory = new PaymentHistory();
        $paymentHistory->user_id = $id;
        $paymentHistory->pay = $packageDetails->pay;
        $paymentHistory->save();

        $membership_get_id = Membership::where('user_id', $id)->first();
        $membership = Membership::find($membership_get_id->id);
        $old_package = Package::find($membership->package_id);
        $currentTime = Carbon::now();
        $membership->package_id = $packageDetails->id;
        $membership->sub_update_date = $currentTime;
        $membership->sub_id = $stripe_sub;
        $membership->daily_date = $currentTime;
        $membership->weekly_date = $currentTime;
        $membership->monthly_date = $currentTime;
        $membership->name = $packageDetails->name;
        $membership->boxfight_quantity = $packageDetails->boxfight_quantity;
        $membership->daily_allowed = $packageDetails->daily_allowed;
        $membership->weekly_allowed = $packageDetails->weekly_allowed;
        $membership->monthly_allowed = $packageDetails->monthly_allowed;
        $membership->membership_quantity = $quantity;
        $membership->pay = $packageDetails->pay;
        $membership->save();

        $update = [];
        $update['previous_package'] = $old_package->name;
        $update['previous_payment'] = $old_package->pay;
        $update['new_package'] = $packageDetails->name;
        $update['new_payment'] = $packageDetails->pay;
        \Notification::send(
            new Slack(),
            new SlackNotification(
                User::find($id),
                Card::find($request->cardID),
                $update,
                'upgrade',
            )
        );
        return response()->json(
            [
                'success' => true,
                'message' => 'Record Updated',
            ]
        );
    }


    public function update($quantity, $id, $cardID)
    {
        $stripe_sub = Membership::getUserSubscriptionId($id);
        $paymentID = Card::getPaymentMethod($cardID);
        $stripe = User::getUserStripeId($id);
        $ret = Card::makeDefaultMethodForUser($stripe, $paymentID->stripe_payment_method);
        if (!$ret) {
            return response()->json(['error' => 'Some error occured with stripe payment.'], 400);
        }
        if ($ret['error']) {
            return response()->json(['error' => $ret['error']], 400);
        }

        $plan = Package::getPlanName($quantity);
        if (!$plan) {
            return response()->json(
                [
                    'message' => 'Package not found'
                ],
                400
            );
        }

        $error = 0;
        try {
            // Use Stripe's library to make requests...
            $subscription = \Stripe\Subscription::retrieve($stripe_sub->sub_id);
            $sub_return = \Stripe\Subscription::update(

                $stripe_sub->sub_id,

                [
                    'cancel_at_period_end' => false,
                    'proration_behavior' => 'always_invoice',
                    'items' => [
                        [
                            'id' => $subscription->items->data[0]->id,
                            'plan' => $plan,
                            'quantity' => $quantity,
                        ],
                    ],
                ]
            );
        } catch (\Stripe\Exception\CardException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $error = $e->getError()->message;
        } catch (Exception $e) {
            $error = $e->getError()->message;
        }
        if ($error) {
            return response()->json(
                [
                    'message' => $error
                ],
                400
            );
        }


        return $sub_return->id;
    }


    /**
     * @OA\Get(
     *     path="/api/membership/check-if-exists/{id}",
     *     tags={"membership"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User ID of Customer",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Check if a User has existing membership Record")
     * )
     */
    public function checkIfExists($id)
    {
        $data = Membership::checkIfMembershipExists($id);
        if ($data) {
            $error = 0;
            try {
                // Use Stripe's library to make requests...
                // $invoice = \Stripe\Invoice::upcoming(
                //     [
                //         "customer" => $data->stripe_id,
                //         "subscription" => $data->sub_id,
                //     ]
                // );

                $invoice = new \Stripe\StripeClient(
                    config('services.stripe.secret')
                  );
                  $return = $invoice->subscriptions->retrieve(
                    $data->sub_id,
                    []
                  );

            } catch (\Stripe\Exception\CardException $e) {
                $error = $e->getError()->message;
            } catch (\Stripe\Exception\RateLimitException $e) {
                $error = $e->getError()->message;
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                $error = $e->getError()->message;
            } catch (\Stripe\Exception\AuthenticationException $e) {
                $error = $e->getError()->message;
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                $error = $e->getError()->message;
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $error = $e->getError()->message;
            } catch (Exception $e) {
                $error = $e->getError()->message;
            }
            if ($error) {
                return response()->json(
                    [
                        'message' => $error
                    ],
                    400
                );
            }

            $defaultPaymentMethod = Card::getDefaultFromStripe($data->stripe_id);
            if ($defaultPaymentMethod['error']) {
                return response()->json(
                    [
                        'message' => $error
                    ],
                    400
                );
            }

            $packageDetails = Package::find($data->package_id);
            if($return->cancel_at_period_end){
                return response()->json(
                    [
                        'status' => 'success',
                        'result' => 'true',
                        'message' => 'Membership Record Exists',
                        'membership_package_id' => $packageDetails->id,
                        'membership_package_name' => $packageDetails->name,
                        'membership_price' => $packageDetails->pay.' €',
                        'expiry_date' => date('d-m-Y', $return->current_period_end),
                        'card_details' => $defaultPaymentMethod,
                    ]
                );
            }
            else{
                return response()->json(
                    [
                        'status' => 'success',
                        'result' => 'true',
                        'message' => 'Membership Record Exists',
                        'membership_package_id' => $packageDetails->id,
                        'membership_package_name' => $packageDetails->name,
                        'membership_price' => $packageDetails->pay.' €',
                        'next_payment_due' => date('d-m-Y', $return->current_period_end),
                        'card_details' => $defaultPaymentMethod,
                    ]
                );
            }

        }

        return response()->json(
            [
                'status' => 'success',
                'result' => 'false',
                'message' => 'Membership Record Does not Exist'
            ]
        );
    }


    public function viewAllMemberships()
    {
        return response()->json(Membership::with('user')->get());
    }


    public function getDeletedMemeberships()
    {
        return response()->json(Membership::onlyTrashed()->with('user')->get());
    }

    /**
     * @OA\Get(
     *     path="/api/membership/check-if-active/{id}",
     *     tags={"membership"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User ID of Customer",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Check if User's membership is active or expired/inactive")
     * )
     */

    public function checkIfMembershipActive($id)
    {
        if (!Membership::checkIfMembershipExists($id)) {
            return response()->json(
                [
                    'message' => 'Membership not found for this user'
                ],
                400
            );
        }


        if (Membership::checkPermission($id)) {
            return response()->json(
                [
                    'status' => 'success',
                    'result' => 'true',
                    'message' => 'Membership still active'
                ]
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'result' => 'false',
                'message' => 'Inactive/Expired Membership'
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/api/membership/deactivate-membership/{id}",
     *     tags={"membership"},
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User ID of Customer",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Deactivate User's membership")
     * )
     */


    public function deactivateMembership($id)
    {
        $membership = Membership::where('user_id', $id)->first();
        if (!$membership) {
            return response()->json(
                [
                    'message' => 'Membership record not found'
                ],
                400
            );
        }
        $membership->permission = 0;
        $membership->save();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Membership deactivated'
            ]
        );
    }

}
