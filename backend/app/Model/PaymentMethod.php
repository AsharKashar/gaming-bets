<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\PaymentMethod
 *
 * @property int $id
 * @property int $user_id
 * @property string $payment_method_id
 * @property string $brand
 * @property int $last4
 * @property int $exp_month
 * @property int $exp_year
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $formated_exp_month
 * @property-read mixed $formated_exp_year
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod whereExpMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod whereExpYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod whereLast4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod wherePaymentMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentMethod whereUserId($value)
 * @mixin \Eloquent
 */
class PaymentMethod extends Model
{
    protected $table = "payment_method";

    protected $appends = [
        'formated_exp_month',
        'formated_exp_year',
    ];

    public static function addPaymentMethod($data, $user_id = false)
    {
        if (!$user_id) {
            $user_id = auth()->id();
        }
        $PaymentMethod = new self();

        $PaymentMethod->user_id = $user_id;
        $PaymentMethod->payment_method_id = $data['payment_method_id'];
        $PaymentMethod->brand = $data['brand'];
        $PaymentMethod->name = $data['name'];
        $PaymentMethod->last4 = $data['last4'];
        $PaymentMethod->exp_month = $data['exp_month'];
        $PaymentMethod->exp_year = $data['exp_year'];
        $PaymentMethod->created_at = now();
        $PaymentMethod->updated_at = now();

        return $PaymentMethod->save();
    }

    public function getFormatedExpMonthAttribute()
    {
        return str_pad($this->exp_month, 2, "0", STR_PAD_LEFT);
    }

    public function getFormatedExpYearAttribute()
    {
        return ($this->exp_year - 2000);
    }
}
