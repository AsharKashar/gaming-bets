<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Locale;

/**
 * App\Model\FaqCatagories
 *
 * @property int $id
 * @property int $locale_id
 * @property string $catagory_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Model\Locale $locale
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\FaqQuestions[] $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqCatagories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqCatagories newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\FaqCatagories onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqCatagories query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqCatagories whereCatagoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqCatagories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqCatagories whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqCatagories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqCatagories whereLocaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqCatagories whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\FaqCatagories withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\FaqCatagories withoutTrashed()
 * @mixin \Eloquent
 */
class FaqCatagories extends Model
{
    use SoftDeletes;

    protected $hidden = ['created_at', 'updated_at'];

    //
    public function questions()
    {
        return $this->hasMany(FaqQuestions::class, 'faq_catagory_id');
    }

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'locale_id');
    }
}
