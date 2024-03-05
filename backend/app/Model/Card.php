<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * App\Model\Card
 *
 * @property int $id
 * @property int $user_id
 * @property int $last_four
 * @property string $expiry
 * @property string $brand
 * @property string $stripe_payment_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Card onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card whereExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card whereLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card whereStripePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Card withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Card withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Card whereName($value)
 */
class Card extends Model
{
    use SoftDeletes;

    protected $hidden = ['stripe_payment_method', 'deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //
    public static function addPaymentMethodDB($paymentMethod, $id, $name)
    {
        $card = new Card();
        $card->user_id = $id;
        $card->name = $name;
        $card->last_four = $paymentMethod->card->last4;
        $card->expiry = Carbon::createFromFormat(
            'm-Y',
            $paymentMethod->card->exp_month.'-'.$paymentMethod->card->exp_year
        );
        $card->brand = $paymentMethod->card->brand;
        $card->stripe_payment_method = $paymentMethod->id;
        $card->save();
        return $card;
    }


    public static function createPaymentMethod($token)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $error = 0;

        try {
            // Use Stripe's library to make requests...
            $paymentMethod = $stripe->paymentMethods->create(
                [
                    'type' => 'card',
                    'card' => [
                        'token' => $token,
                    ],
                ]
            );
        } catch (\Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught

            $error = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error = $e->getError()->message;
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error = $e->getError()->message;
        }
        $paymentMethod['error'] = $error;
        return $paymentMethod;
    }

    public static function attachPaymentMethod($paymentMethod, $stripe_id)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $error = 0;

        try {
            // Use Stripe's library to make requests...
            $cardDetails = $stripe->paymentMethods->attach(
                $paymentMethod->id,
                ['customer' => $stripe_id]
            );
        } catch (\Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught

            $error = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error = $e->getError()->message;
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error = $e->getError()->message;
        }
        return $error;
    }

    public static function getPaymentMethod($cardID)
    {
        $paymentMethod = self::find($cardID);
        return $paymentMethod;
    }

    public static function getAllPaymentMethod($id)
    {
        $paymentMethods = self::where('user_id', $id)->get();
        return $paymentMethods;
    }

    public static function getDefaultFromStripe($stripe_id)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $error = 0;
        try {
            // Use Stripe's library to make requests...
            $defaultPaymentMethod = $stripe->customers->retrieve(
                $stripe_id,
                []
            );
        } catch (\Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught

            $error = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error = $e->getError()->message;
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error = $e->getError()->message;
        }
        $cardDetails['error'] = $error;
        $cardDetails = self::getPaymentMethodusingPaymentID(
            $defaultPaymentMethod->invoice_settings->default_payment_method
        );
        return $cardDetails;
    }

    public static function getPaymentMethodusingPaymentID($defaultID)
    {
        $paymentMethod = self::where('stripe_payment_method', $defaultID)->first();
        return $paymentMethod;
    }

    public static function makeDefaultMethodForUser($stripe_id, $paymentMethodID)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $error = 0;


        try {
            // Use Stripe's library to make requests...
            $data = \Stripe\Customer::update(
                $stripe_id,
                [
                    'invoice_settings' => [
                        'default_payment_method' => $paymentMethodID,
                    ],
                ]
            );
        } catch (\Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught

            $error = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error = $e->getError()->message;
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error = $e->getError()->message;
        }
        $data['error'] = $error;

        return $data;
    }

    public static function detachPaymentMethod($paymentMethodID)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $error = 0;
        try {
            // Use Stripe's library to make requests...
            $stripe->paymentMethods->detach(
                $paymentMethodID,
                []
            );
        } catch (\Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught

            $error = $e->getError()->message;
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            $error = $e->getError()->message;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error = $e->getError()->message;
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error = $e->getError()->message;
        }

        return $error;
    }

    public static function deletePaymentMethodRecord($cardID)
    {
        $paymentMethod = self::find($cardID);
        $paymentMethod->delete();
        return;
    }

}
