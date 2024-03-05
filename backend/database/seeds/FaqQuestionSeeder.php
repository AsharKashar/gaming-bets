<?php

use App\Model\FaqCatagories;
use App\Model\Locale;
use Illuminate\Database\Seeder;

class FaqQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $catagories = FaqCatagories::all();
        foreach($catagories as $catagory){
            for($j=1;$j<6;$j++){
                if($catagory->locale_id == Locale::where('code','en')->first()->id){
                    DB::table('faq_questions')->insert([
                        'faq_catagory_id'      => $catagory->id,
                        'question' => "This is question number ".$j." for catagory ".$catagory->catagory_name,
                        'answer' => "This is answer for question number ".$j." for catagory ".$catagory->catagory_name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

        }


        foreach($catagories as $catagory){
            for($j=1;$j<6;$j++){
                if($catagory->locale_id == Locale::where('code','es')->first()->id){
                    DB::table('faq_questions')->insert([
                        'faq_catagory_id'      => $catagory->id,
                        'question' => "Esta es la pregunta número ".$j." para la categoría ".$catagory->catagory_name,
                        'answer' => "Esta es la respuesta a la pregunta número ".$j." para la categoría ".$catagory->catagory_name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

        }
    }
}
