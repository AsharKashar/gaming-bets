<?php

use App\Model\EntryFee;
use Illuminate\Database\Migrations\Migration;

class SeedTournamentsFeesAndSizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $entryFees = [2.5, 5, 7.5, 10, 15, 20, 25];

        foreach ($entryFees as $entryFee) {
            EntryFee::insert([
                "fee" => $entryFee
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
        //
    }
}
