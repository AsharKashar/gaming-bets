<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeederToFaqCatagories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::table('locales')->delete();
        // DB::table('faq_catagories')->delete();
        // Artisan::call('db:seed', array('--class' => 'localeSeederClass'));
        // Artisan::call('db:seed', array('--class' => 'FaqCatagorySeederClass'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
