<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\GlobalOptions
 *
 * @property int $id
 * @property string $type
 * @property mixed $fields
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GlobalOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GlobalOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GlobalOptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GlobalOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GlobalOptions whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GlobalOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GlobalOptions whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GlobalOptions whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $group
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\GlobalOptions whereGroup($value)
 */
class GlobalOptions extends Model
{
    const GROUP = [
      'links'
    ];

    const TYPE = [
        'links' => [
            'join_links' => 'Join links',
            'support_links' => 'Support links',
            'stream_links' => 'Stream links'
        ]
    ];

    const TYPE_OPTIONS = [
      'links' => ['discord' => 'Discord', 'insta' => 'Instagram', 'twitch' => 'twitch', 'youtube' => 'YouTube'],
    ];

    protected $fillable = [
        'type',
        'group',
        'fields',
    ];

    protected $casts = [
        'fields' =>'json',
    ];

    public function setFieldsAttribute($value)
    {
        $this->attributes['fields'] = json_encode($value);
    }
}
