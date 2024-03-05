<?php

use App\Model\Status;
use Illuminate\Database\Migrations\Migration;

class AddCanceledStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Status::create([
            'name' => 'Canceled',
            'type' => 'canceled',
            'group' => 'tournament',
            'order' => 6
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
