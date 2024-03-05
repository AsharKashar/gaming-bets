<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\PaymentHistory;
use App\Tournament;
use App\UserCard;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class PaymentSetupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function stripePay($data, $amount, $description, $onSuccess)
    {
        $stripe = Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $token = $stripe->tokens()->create(
                [
                    'card' => [
                        'number' => $data['card_no'],
                        'exp_month' => $data['exp_month'],
                        'exp_year' => $data['exp_year'],
                        'cvc' => $data['cvv_number'],
                    ],
                ]
            );


            if (!isset($token['id'])) {
                return back();
            }


            $charge = $stripe->charges()->create(
                [
                    'card' => $token['id'],
                    'currency' => config('setting.currency'),
                    'amount' => $amount,
                    'description' => $description,
                ]
            );

            if ($charge['status'] == 'succeeded') {
                call_user_func($onSuccess);
                return ["type" => "paid"];
            } else {
                return ["type" => "error", "msg" => "Not Paid"];
            }
        } catch (Exception $e) {
            return ["type" => "exception", "msg" => $e->getMessage()];
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return ["type" => "exception", "msg" => $e->getMessage()];
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return ["type" => "exception", "msg" => $e->getMessage()];
        }
    }

    public function postPaymentStripe(PaymentRequest $request)
    {
        $tournament = Tournament::find($request->tournament_id);
        /*if ($tournament->bracket_size > $tournament->players->count()) {
            $amount = $tournament->entry_fee;

            $result = $this->stripePay(
                $request->all(),
                $amount,
                'Payment to join tournament',
                function () use ($request, $tournament, $amount) {
                    UserCard::create(
                        [
                            'number' => $request->get('card_no'),
                            'exp_month' => $request->get('exp_month'),
                            'exp_year' => $request->get('exp_year'),
                            'cvc' => $request->get('cvv_number'),
                            'user_id' => auth()->id(),
                        ]
                    );
                    $tournament->players()->attach(auth()->id());

                    PaymentHistory::create([
                        "user_id" => auth()->id(),
                        "pay" => $amount,
                        "tournament_id" => $tournament->id,
                        "bomb" => 0,
                        "withdrawal" => false,
                    ]);
                }
            );

            if ($result['type'] == "paid") {
                session()->flash('msg', 'Paid &  Tournament Joined Successfully');
                return redirect()->back();
            } elseif ($result['type'] == "error") {
                session()->flash('msg', $result['msg']);
                return redirect()->back();
            } else {
                return redirect()->back()->withErrors([$result['msg']]);
            }
        } else {
            return redirect()->back()->with(["msg" => "Cannot not join, Tournament already filled"]);
        }*/
    }

    public function awardPayment(PaymentRequest $request)
    {
        $result = $this->stripePay(
            $request->all(),
            $request->cost,
            "Payment to purchase bomb",
            function () use ($request) {
                UserCard::create(
                    [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('exp_month'),
                        'exp_year' => $request->get('exp_year'),
                        'cvc' => $request->get('cvv_number'),
                        'user_id' => auth()->id(),
                    ]
                );

                PaymentHistory::create(
                    [
                        "user_id" => auth()->id(),
                        "pay" => $request->cost,
                        "tournament_id" => null,
                        "bomb" => 0,
                        "withdrawal" => false,
                    ]
                );
            }
        );
        if ($result['type'] == "paid") {
            session()->flash('msg', 'Purchased Successfully');
            return redirect()->back();
        } elseif ($result['type'] == "error") {
            session()->flash('msg', $result['msg']);
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors([$result['msg']]);
        }
    }



    public function getPaymentHistory($id)
    {
        return PaymentHistory::where('user_id', $id)->get();
    }
}
