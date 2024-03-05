<?php

namespace App\Http\Controllers;

use App\Model\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class PaymentController extends Controller
{
    public function addCart(Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'name' => ['required', 'string'],
                'cardnumber' => ['required', 'numeric'],
                'mmyy' => ['required'],
                'cvc' => ['required', 'numeric'],
            ]
        );

        $mmyy = explode('/', $request->mmyy);
        $exp_month = intval($mmyy[0]);
        $exp_year = (2000 + $mmyy[1]);


        $stripe = new \Stripe\StripeClient(
            config('services.stripe.secret')
        );

        $PaymentMethod = $stripe->paymentMethods->create(
            [
                'type' => 'card',
                'card' => [
                    'number' => $request->cardnumber,
                    'exp_month' => $exp_month,
                    'exp_year' => $exp_year,
                    'cvc' => $request->cvc,
                ],
            ]
        );

        $attach = $stripe->paymentMethods->attach(
            $PaymentMethod->id,
            ['customer' => Auth::user()->stripe_id]
        );

        $data = [
            'payment_method_id' => $attach->id,
            'name' => $request->name,
            'brand' => $attach->card->brand,
            'last4' => $attach->card->last4,
            'exp_month' => $attach->card->exp_month,
            'exp_year' => $attach->card->exp_year
        ];

        PaymentMethod::addPaymentMethod($data, Auth::user()->id);


        return response()->json(['status' => 'success', 'message' => 'Payment method successfully added']);
    }

    public function getCart()
    {
        $methods = PaymentMethod::where('user_id', Auth::user()->id)->get();

        return response()->json(['status' => 'success', 'data' => $methods]);
    }
}
