<?php

use App\Model\Frequency;
use Illuminate\Database\Migrations\Migration;

class SeedFrequencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Frequency::create([
            'name' => 'Daily'
        ]);

        Frequency::create([
            'name' => 'Weekly'
        ]);

        Frequency::create([
            'name' => 'Monthly'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Frequency::truncate();
    }
}
