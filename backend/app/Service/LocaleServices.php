<?php


namespace App\Service;
use App\Model\Locale;
use App;
use Illuminate\Database\Eloquent\Collection;

class LocaleServices
{
    public static function getFirstLocaleToCollection(Collection $collection)
    {
        $locale_id = optional(Locale::firstWhere('code', App::getLocale()))->id;
        $res = $collection->firstWhere('locale_id', $locale_id);
        if (!$res) {
            $locale_id = Locale::firstWhere('code','en')->id;
            $res = $collection->firstWhere('locale_id', $locale_id) ?? $collection->first();
        }
        return $res;
    }
}
