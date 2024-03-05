<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleAndDescriptionColumnToBombPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bomb_packages', function (Blueprint $table){
            $table->json('description')->after('id')->nullable();
            $table->string('title')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bomb_packages', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('title');
        });
    }
}