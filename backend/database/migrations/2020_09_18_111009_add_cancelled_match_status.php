<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Model\Status;

class AddCancelledMatchStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Status::create([
            'name' => 'Cancelled',
            'type' => Status::MATCH_TYPES['cancelled'],
            'group' => Status::GROUPS['match'],
            'order' => 4
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
