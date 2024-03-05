<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\FaqAskQuestion
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $description
 * @property string|null $file_url
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\FaqAskQuestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion whereFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqAskQuestion whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\FaqAskQuestion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\FaqAskQuestion withoutTrashed()
 * @mixin \Eloquent
 */
class FaqAskQuestion extends Model
{
    use SoftDeletes;

    //
}
