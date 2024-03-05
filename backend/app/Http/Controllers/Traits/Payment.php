<?php

namespace App\Http\Controllers\Traits;

use Cartalyst\Stripe\Laravel\Facades\Stripe;

trait Payment
{

    function pay($data, $amount, $description, $onSuccess)
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

    function stripeTransfer($destination, $amount, $onSuccess)
    {
//        $stripe = Stripe::setApiKey(config('services.stripe.secret'));
        $stripe = Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

        try {
            $charge = $stripe->transfers()->create(
                [
                    'amount' => $amount,
//                    'currency' => config('setting.currency'),
                    'currency' => "usd",
                    'destination' => $destination,
                ]
            );

            if ($charge['status'] == 'succeeded') {
                call_user_func($onSuccess);
                return ["type" => "transfer", 'msg' => 'Transfer successfully'];
            } else {
                return ["type" => "error", "msg" => "Not transfer"];
            }
        } catch (Exception $e) {
            return ["type" => "exception", "msg" => $e->getMessage()];
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return ["type" => "exception", "msg" => $e->getMessage()];
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return ["type" => "exception", "msg" => $e->getMessage()];
        }
    }


}
