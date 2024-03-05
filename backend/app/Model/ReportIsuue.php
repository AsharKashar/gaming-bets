<?php

namespace App\Model;

use App\Model\BaseModel as Model;

/**
 * App\Model\ReportIsuue
 *
 * @property int $id
 * @property string $title
 * @property string $email
 * @property string $description
 * @property int $user_id
 * @property string $status
 * @property string|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\ReportIsuue whereUserId($value)
 * @mixin \Eloquent
 */
class ReportIsuue extends Model
{
    protected $table = 'report_isuues';

    protected $fillable = ['title', 'email', 'description', 'user_id', 'status', 'file'];

    public static function addUpdate($input, $id = 0)
    {
        if ($id == 0) {
//            $user = auth()
            $path = self::saveFile('file', '/issues/');
            return self::create(
                [
                    'title' => $input['title'],
                    'email' => $input['email'],
                    'description' => $input['description'],
                    'user_id' => auth()->id(),
                    'file' => $path,
                ]
            );
        } else {
            dd("NO Update");
        }
    }

}
