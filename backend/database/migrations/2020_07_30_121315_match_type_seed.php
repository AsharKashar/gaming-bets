<?php

use App\Model\MatchType;
use Illuminate\Database\Migrations\Migration;

class MatchTypeSeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        MatchType::create([
            'name' => 'Battle Royale'
        ]);

        MatchType::create([
            'name' => 'Demolition'
        ]);

        MatchType::create([
            'name' => 'Search & Destroy'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        MatchType::truncate();
    }
}
