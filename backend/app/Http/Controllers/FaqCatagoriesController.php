<?php

namespace App\Http\Controllers;

use App;
use App\Model\FaqCatagories;
use App\Model\FaqQuestions;
use App\Model\Locale;
use Illuminate\Http\Request;

class FaqCatagoriesController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api/FAQ/get-all-faqs",
     *     tags={"FAQ"},
     *     @OA\Response(response="200", description="Get FAQs with ")
     * )
     */
    public function getFaqs()
    {
        $locale = App::getLocale();
        if (!$locale) {
            $locale = 'en';
        }
        $locale_data = Locale::where('code', $locale)->first();
        $data = FaqCatagories::where('locale_id', $locale_data->id)->get();
        foreach ($data as $key => $value) {
            $questions = FaqQuestions::where('faq_catagory_id', $value->id)->get(['id', 'question'])->take(4);
            $data[$key]['questions'] = $questions;
        }
        return $data;
    }

    /**
     * @OA\Get(
     *     path="/api/FAQ/get-catagory_faqs/{catagory_id}",
     *     tags={"FAQ"},
     * @OA\Parameter(
     *     name="catagory_id",
     *     in="path",
     *     description="FAQ catagory ID",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Get questions of a particular catagory")
     * )
     */
    public function getCatagoryFaqs($catagory_id)
    {
        $data = FaqQuestions::where('faq_catagory_id', $catagory_id)->get();
        return $data;
    }

    /**
     * @OA\Get(
     *     path="/api/FAQ/get-catagories",
     *     tags={"FAQ"},
     *     @OA\Response(response="200", description="Get a list of all catagories")
     * )
     */
    public function getCatagories()
    {
        $locale = App::getLocale();
        if (!$locale) {
            $locale = 'en';
        }
        $locale_data = Locale::where('code', $locale)->first();
        $data = FaqCatagories::where('locale_id', $locale_data->id)->get();
        return $data;
    }
}
