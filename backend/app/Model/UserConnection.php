<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserConnection
 *
 * @property int $id
 * @property int $user_id
 * @property string $service_type
 * @property string $social_id
 * @property mixed $service_info
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection whereServiceInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection whereServiceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection whereSocialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $data
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserConnection whereData($value)
 */
class UserConnection extends Model
{
    public static $serviceTypes = [
        'EPIC_GAMES' => 'epic_games',
        'STEAM' => 'steam'
    ];

    protected $fillable = [
        'user_id',
        'service_type',
        'service_info',
        'social_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getServiceInfoAttribute($serviceInfo)
    {
        return json_decode($serviceInfo, true) ?: [];
    }

    public function setServiceInfoAttribute($serviceInfo)
    {
        if (is_array($serviceInfo)) {
            $this->attributes['service_info'] = json_encode($serviceInfo);
        }
    }
}
