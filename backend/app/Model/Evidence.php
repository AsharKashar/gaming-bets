<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Evidence
 *
 * @property int $id
 * @property int $match_team_id
 * @property $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Evidence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Evidence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Evidence query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Evidence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Evidence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Evidence whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Evidence extends Model
{
    protected $fillable = [
        'match_team_id',
        'data'
    ];

    protected $with = [
        'files'
    ];

    /**
     * @param $data
     * @return array|mixed
     */
    public function getDataAttribute($data)
    {
        return json_decode($data, true) ?: [];
    }

    /**
     * @param $data
     */
    public function setDataAttribute($data)
    {
        if (is_array($data)) {
            $this->attributes['data'] = json_encode($data);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany(File::class, 'evidence_files');
    }

}
