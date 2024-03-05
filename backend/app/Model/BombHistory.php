<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BombHistory
 *
 * @property int $id
 * @property int $user_id
 * @property float $bombs_free
 * @property float $bombs_paid
 * @property float $bombs_reward
 * @property string $type
 * @property array|mixed $pay
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory whereBombsFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory whereBombsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory whereBombsReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory wherePay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BombHistory whereUserId($value)
 * @mixin \Eloquent
 */
class BombHistory extends Model
{
    const TYPES = [
        'tournament' => 'tournament_id',
        'buyBombs' => 'buy_bombs',
        'boxMatch' => 'box_match',
        'winnerReward' => 'winner_reward'
    ];

    protected $fillable = [
        'user_id',
        'bombs_paid',
        'bombs_reward',
        'bombs_free',
        'type',
        'pay',
    ];

    /**
     * @param $serviceInfo
     * @return array|mixed
     */
    public function getPayAttribute($data)
    {
        return json_decode($data, true) ?: [];
    }

    /**
     * @param $data
     */
    public function setPayAttribute($data)
    {
        if (is_array($data)) {
            $this->attributes['pay'] = json_encode($data);
        }
    }

}
