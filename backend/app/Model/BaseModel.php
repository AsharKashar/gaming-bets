<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    protected $guarded = [];

    public static function saveFile($field_name, $storagePath)
    {
        $imageName = time().'.'.request()->{$field_name}->getClientOriginalExtension();
        request()->{$field_name}->move(storage_path('app/public/'.$storagePath), $imageName);
        return $storagePath.$imageName;
    }


}
