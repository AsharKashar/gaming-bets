<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToFaqCatagories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faq_catagories', function (Blueprint $table) {
            //
            $table->dropColumn('locale');
        });
        Schema::table('faq_catagories', function (Blueprint $table) {
            //
            $table->integer('locale_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faq_catagories', function (Blueprint $table) {
            //
            $table->dropColumn('locale');
        });
    }
}
