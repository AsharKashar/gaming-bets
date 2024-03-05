<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTablesBracketSizesAndBracketTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('bracket_types')) {
            Schema::dropIfExists('bracket_types');
        }
        if (Schema::hasTable('bracket_sizes')) {
            Schema::dropIfExists('bracket_sizes');
        }
    }
}
