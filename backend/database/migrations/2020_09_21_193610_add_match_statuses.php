<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatchStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        \App\Model\Status::truncate();
        $order = 1;
        foreach (\App\Model\Status::MATCH_TYPES as $type) {
            \App\Model\Status::create([
                'name' => ucfirst($type),
                'type' => $type,
                'group' => \App\Model\Status::GROUPS['match'],
                'order' => $order
            ]);
            $order++;
        }

        $order = 1;
        foreach (\App\Model\Status::TOURNAMENT_TYPES as $type) {
            \App\Model\Status::create([
                'name' => ucfirst($type),
                'type' => $type,
                'group' => \App\Model\Status::GROUPS['tournament'],
                'order' => $order
            ]);
            $order++;
        }
        Schema::enableForeignKeyConstraints();
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
