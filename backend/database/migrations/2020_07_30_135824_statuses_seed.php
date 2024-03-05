<?php

use App\Model\Status;
use Illuminate\Database\Migrations\Migration;

class StatusesSeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Status::create([
            'name' => 'Upcoming',
            'type' => 'upcoming',
            'group' => 'tournament',
            'order' => 1
        ]);

        Status::create([
            'name' => 'Registration',
            'type' => 'registration',
            'group' => 'tournament',
            'order' => 2
        ]);

        Status::create([
            'name' => 'Started',
            'type' => 'started',
            'group' => 'tournament',
            'order' => 3
        ]);

        Status::create([
            'name' => 'Ended',
            'type' => 'ended',
            'group' => 'tournament',
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
        Status::truncate();
    }
}
