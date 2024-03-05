<?php

use App\Model\Region;
use Illuminate\Database\Migrations\Migration;

class MoveRegionsToRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $regions = [
            'EU West', 'EU East', 'EU North', 'Spain', 'Africa 1', 'Africa 2', 'Asia 1', 'Asia 2', 'Dubai',
            'India', 'Australia', 'Japan', 'China', 'US West', 'US East', 'US South-East', 'US South - West', 'Chile',
            'Brazil'
        ];

        foreach ($regions as $region) {
            Region::create([
                'name' => $region,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Region::truncate();
    }
}
