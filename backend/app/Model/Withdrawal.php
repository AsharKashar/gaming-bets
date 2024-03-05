<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Withdrawal
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $account_number
 * @property string|null $account_holdername
 * @property string|null $bank_name
 * @property int|null $last4
 * @property string|null $account_holdertype
 * @property string|null $currency
 * @property int|null $routing_number
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $formated_date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereAccountHoldername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereAccountHoldertype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereLast4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereRoutingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Withdrawal whereUserId($value)
 * @mixin \Eloquent
 */
class Withdrawal extends Model
{
    protected $table = "withdrawal";
    protected $primaryKey = "id";
    protected $fillable = [
        'user_id',
        'account_number',
        'account_holdername',
        'bank_name',
        'last4',
        'account_holdertype',
        'currency',
        'routing_number',
    ];

    protected $appends = [
        'formated_date',
    ];

    public static function addWithdrawal($data, $user_id = 0)
    {
        if ($user_id == 0) {
            $user_id = auth()->id();
        }
        $withDrawal = new self();

        $withDrawal->user_id = $user_id;
        $withDrawal->account_number = $data['account_number'];
        $withDrawal->account_holdername = $data['account_holdername'];
        $withDrawal->bank_name = $data['bank_name'];
        $withDrawal->last4 = $data['last4'];
        $withDrawal->account_holdertype = $data['account_holdertype'];
        $withDrawal->currency = $data['currency'];
        $withDrawal->routing_number = $data['routing_number'];
        $withDrawal->created_at = now();
        $withDrawal->updated_at = now();

        return $withDrawal->save();
    }

    public function getFormatedDateAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }
}
