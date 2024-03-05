<?php

namespace App\Http\Controllers;

use App;
use App\Model\FaqCatagories;
use App\Model\FaqQuestions;
use App\Model\Locale;
use Illuminate\Http\Request;

class FaqQuestionsController extends Controller
{
    //

    /**
     * @OA\Get(
     *     path="/api/FAQ/search",
     *     tags={"FAQ"},
     * @OA\Parameter(
     *     name="search",
     *     in="query",
     *     description="The words to search for",
     *     required=false,
     * ),
     *     @OA\Response(response="200", description="Returns list of FAQs that match the words entered in search parameter")
     * )
     */

    public function searchQuestions(request $request)
    {
        $locale = App::getLocale();
        if (!$locale) {
            $locale = 'en';
        }
        $locale_data = Locale::where('code', $locale)->first();
        $search = $request->input('search');
        $results = [];
        if(!$request->search){
            $locale_data = Locale::where('code', $locale)->first();
            $data = FaqCatagories::where('locale_id', $locale_data->id)->get();
            foreach ($data as $value) {
                $questions = FaqQuestions::where('faq_catagory_id', $value->id)->get();
                foreach($questions as $question){
                    $results[] = $question;
                }
            }
            return $results;
        }

        else{
            $searchResults = FaqQuestions::seaarchQuery($search);
            foreach ($searchResults as $searchResult) {
                if (FaqCatagories::find($searchResult->searchable->faq_catagory_id)->locale_id == $locale_data->id) {
                    $results[] = ($searchResult->searchable);
                }
            }
            return $results;
        }
    }

    public function getQuestionAnswer($question_id)
    {
        $data = FaqQuestions::with('catagory')->find($question_id);
        return $data;
    }
}
