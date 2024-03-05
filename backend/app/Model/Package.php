<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Package
 *
 * @property int $id
 * @property string $name
 * @property string $stripe_plan
 * @property int $stripe_quantity
 * @property int $boxfight_quantity
 * @property int $daily_allowed
 * @property int $weekly_allowed
 * @property int $monthly_allowed
 * @property int $wagers
 * @property int $money_win_chance
 * @property int $daily_save
 * @property int $pay
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Package onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereBoxfightQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereDailyAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereDailySave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereMoneyWinChance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereMonthlyAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package wherePay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereStripePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereStripeQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereWagers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Package whereWeeklyAllowed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Package withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Package withoutTrashed()
 * @mixin \Eloquent
 */
class Package extends Model
{
    use SoftDeletes;

    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'stripe_plan',
        'boxfight_quantity',
        'daily_allowed',
        'weekly_allowed',
        'monthly_allowed',
        'pay',
        'daily_save',
        'money_win_chance',
        'wagers'
    ];

    protected $dates = ['deleted_at'];

    public static function getPlanName($quantity)
    {
        $package = self::where('stripe_quantity', $quantity)->first();
        if (!$package) {
            return false;
        }
        return $package->stripe_plan;
    }

    public static function getPackage($id)
    {
        $package = self::find($id);
        if (!$package) {
            return false;
        }
        return $package;
    }

    public static function getQuantityOfPackage($id)
    {
        $package = self::find($id);
        if (!$package) {
            return false;
        }
        return $package->stripe_quantity;
    }
}
