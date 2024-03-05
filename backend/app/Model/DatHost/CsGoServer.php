<?php

namespace App\Model\DatHost;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\DatHost\CsGoServer
 *
 * @property int $id
 * @property string $name
 * @property string $game
 * @property string|null $autostop
 * @property int|null $autostop_minutes
 * @property string|null $custom_domain
 * @property string $enable_mysql
 * @property string $location
 * @property mixed|null $scheduled_commands
 * @property string|null $user_data
 * @property mixed|null $csgo_settings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereAutostop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereAutostopMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereCsgoSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereCustomDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereEnableMysql($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereGame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereScheduledCommands($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DatHost\CsGoServer whereUserData($value)
 * @mixin \Eloquent
 */
class CsGoServer extends Model
{
    protected $table = "dat_host_cs_go_servers";

//    protected $fillable = [
//        'autostop',
//        'autostop_minutes',
//        'custom_domain',
//        'enable_mysql',
//        'game',
//        'location',
//        'name',
//        'scheduled_commands',
//        'user_data',
//        'csgo_settings',
//    ];
}
