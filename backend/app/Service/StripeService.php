<?php


namespace App\Service;


use Stripe\Customer;
use Stripe\Stripe;

class StripeService
{
    /**
     * @param $name
     * @param $email
     * @return string|Customer
     */
    public static function createCustomer($name, $email)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
             return Customer::create(
                [
                    'name' => $name,
                    'email' => $email,
                ]
            );
        } catch(\Exception $e) {
            return $e;
        }
    }
}
