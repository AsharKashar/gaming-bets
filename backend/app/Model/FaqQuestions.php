<?php

namespace App\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Search;

/**
 * App\Model\FaqQuestions
 *
 * @property int $id
 * @property int $faq_catagory_id
 * @property string $question
 * @property string $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Model\FaqCatagories $catagory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqQuestions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqQuestions newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\FaqQuestions onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqQuestions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqQuestions whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqQuestions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqQuestions whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqQuestions whereFaqCatagoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqQuestions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqQuestions whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FaqQuestions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\FaqQuestions withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\FaqQuestions withoutTrashed()
 * @mixin \Eloquent
 */
class FaqQuestions extends Model implements Searchable
{
    use SoftDeletes;

    protected $hidden = ['created_at', 'updated_at'];

    //
    public function catagory()
    {
        return $this->belongsTo(FaqCatagories::class, 'faq_catagory_id');
    }

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->id,
        );
    }

    public static function seaarchQuery($search)
    {
       $return = (new Search())
        ->registerModel(self::class, 'question')
        ->perform($search);
        return $return;
    }
}
