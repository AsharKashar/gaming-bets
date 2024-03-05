<?php

use App\Model\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $statuses = [
            [
                'name' => 'Created',
                'type' => Status::MATCH_TYPES['created'],
                'group' => Status::GROUPS['match'],
                'order' => 1
            ],
            [
                'name' => 'Started',
                'type' => Status::MATCH_TYPES['started'],
                'group' => Status::GROUPS['match'],
                'order' => 2
            ],
            [
                'name' => 'Ended',
                'type' => Status::MATCH_TYPES['ended'],
                'group' => Status::GROUPS['match'],
                'order' => 3
            ]
        ];


        foreach ($statuses as $data) {
            Status::create($data);
        }
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
