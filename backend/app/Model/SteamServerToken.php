<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\SteamServerToken
 *
 * @property int $id
 * @property string $code
 * @property int $game_id
 * @property string|null $used_server_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SteamServerToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SteamServerToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SteamServerToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SteamServerToken whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SteamServerToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SteamServerToken whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SteamServerToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SteamServerToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SteamServerToken whereUsedServerId($value)
 * @mixin \Eloquent
 */
class SteamServerToken extends Model
{
    protected $fillable = [
        'code',
        'game_id',
        'used_server_id',
    ];
}
