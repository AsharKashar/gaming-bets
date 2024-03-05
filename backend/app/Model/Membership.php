<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Membership
 *
 * @property int $id
 * @property string $stripe_id
 * @property string $user_id
 * @property string|null $sub_id
 * @property string|null $plan_id
 * @property string|null $boxfight_quantity
 * @property string|null $daily_allowed
 * @property string|null $weekly_allowed
 * @property string|null $monthly_allowed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $daily_quantity
 * @property string|null $weekly_quantity
 * @property string|null $monthly_quantity
 * @property string|null $membership_quantity
 * @property string|null $permission
 * @property string|null $daily_date
 * @property string|null $weekly_date
 * @property string|null $monthly_date
 * @property string|null $sub_update_date
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $name
 * @property string|null $pay
 * @property-read \App\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Membership onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereBoxfightQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereDailyAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereDailyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereDailyQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereMembershipQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereMonthlyAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereMonthlyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereMonthlyQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership wherePay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership wherePermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereSubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereSubUpdateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereWeeklyAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereWeeklyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership whereWeeklyQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Membership withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Membership withoutTrashed()
 * @mixin \Eloquent
 * @property string $package_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Membership wherePackageId($value)
 */
class Membership extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['stripe_id', 'sub_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function subscriptionData()
    {
        $membershipRecords = self::all();
        foreach ($membershipRecords as $record) {
            if (!$record->permission) {
                return;
            }
            $ch_time = Carbon::parse($record->daily_date);
            $daily_time = $ch_time->diffInHours();
            $mytime = Carbon::now();
            if ($daily_time >= 24) {
                //Refresh Daily
                $record->daily_quantity = 1;
                $record->daily_date = $mytime;
            }
            $ch_time1 = Carbon::parse($record->weekly_date);
            $weekly_time = $ch_time1->diffInHours();
            if ($weekly_time >= 168) {
                //Refresh Weekly
                $record->weekly_quantity = 1;
                $record->weekly_date = $mytime;
            }
            $ch_time2 = Carbon::parse($record->monthly_date);
            $monthly_time = $ch_time2->diffInMonths();
            if ($monthly_time >= 1) {
                //Refresh Monthly
                $record->monthly_quantity = 1;
                $record->monthly_date = $mytime;
            }
            $ch_time3 = Carbon::parse($record->sub_update_date);
            $subscription_time = $ch_time3->diffInMonths();
            if ($subscription_time >= 1) {
                if ($record->membership_quantity == 5) {
                    $record->boxfight_quantity = 25;
                } else {
                    if ($record->membership_quantity == 10) {
                        $record->boxfight_quantity = 60;
                    } else {
                        if ($record->membership_quantity == 15) {
                            $record->boxfight_quantity = 9999;
                        }
                    }
                }
            }
            $record->save();
        }
    }

    public static function checkIfMembershipExists($id)
    {
        $membershipRecord = self::where('user_id', $id)->first();
        if ($membershipRecord) {
            return $membershipRecord;
        }
        return false;
    }

    public static function deleteRecord($sub_id)
    {
        $membershipRecord = self::where('sub_id', $sub_id)->first();
        $membershipRecord->delete();
        return true;
    }

    public static function checkPermission($id)
    {
        $membershipRecord = self::where('user_id', $id)->first();
        if ($membershipRecord->permission) {
            return true;
        }
        return false;
    }


    public static function getUserSubscriptionId($id)
    {
        $membershipRecord = self::where('user_id', $id)->first();
        return $membershipRecord;
    }

    public static function getUserSubscription($id)
    {
        $membershipRecord = self::where('user_id', $id)->get()->count();
        if ($membershipRecord) {
            return $membershipRecord;
        }
        return false;
    }

    public static function checkFreeAllowed($user_id, $repeat, $entry_fee)
    {
        $membership = Membership::where('user_id', $user_id)->first();
        if ($membership) {
            if ($repeat == 'daily') {
                if ($membership->daily_allowed == $entry_fee && $membership->daily_quantity > 0) {
                    $membership->daily_quantity = $membership->daily_quantity - 1;
                    $membership->save();
                    return true;
                }
            }

            if ($repeat == 'weekly') {
                if ($membership->weekly_allowed == $entry_fee && $membership->weekly_quantity > 0) {
                    $membership->weekly_quantity = $membership->weekly_quantity - 1;
                    $membership->save();
                    return true;
                }
            }

            if ($repeat == 'monthly') {
                if ($membership->monthly_allowed == $entry_fee && $membership->monthly_quantity > 0) {
                    $membership->monthly_quantity = $membership->monthly_quantity - 1;
                    $membership->save();
                    return true;
                }
            }

            return false;
        }
    }
}
