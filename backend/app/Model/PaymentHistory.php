<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\PaymentHistory
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $tournament_id
 * @property float|null $bomb
 * @property float $pay
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $withdrawal
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory whereBomb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory wherePay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory whereWithdrawal($value)
 * @mixin \Eloquent
 * @property mixed|null $response_pay
 * @property-read mixed $formated_date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PaymentHistory whereResponsePay($value)
 */
class PaymentHistory extends Model
{
    protected $appends = [
        'formated_date',
    ];

    protected $fillable = [
        'user_id',
        'pay',
        'response_pay'
    ];

    // protected $casts = [
    //     'response_pay' => 'array'
    // ];

    public function getResponsePayAttribute($value)
    {
        return json_decode(json_decode($value, true))?: [];
    }

    public function getFormatedDateAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

}
