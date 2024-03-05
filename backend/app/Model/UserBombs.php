<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserBombs
 *
 * @property int $id
 * @property int $user_id
 * @property float $bombs_free
 * @property float $bombs_reward
 * @property float $bombs_paid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $bombs_total
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserBombs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserBombs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserBombs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserBombs whereBombsFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserBombs whereBombsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserBombs whereBombsReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserBombs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserBombs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserBombs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserBombs whereUserId($value)
 * @mixin \Eloquent
 */
class UserBombs extends Model
{
    protected $fillable = [
        'user_id',
        'bombs_paid',
        'bombs_reward',
        'bombs_free'
    ];

    /**
     * @return mixed
     */
    public function getBombsTotalAttribute()
    {
        return $this->bombs_free + $this->bombs_reward + $this->bombs_paid;
    }
}
