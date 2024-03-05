<?php

use Illuminate\Database\Migrations\Migration;
use App\Model\BombPackage;

class AddSeedBomBackageDescriptionToBombPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        BombPackage::all()->map(function ($bombPackage) {
            $bombPackage->update([
                'description' => [
                    'Enter cash prize tournaments123',
                    'Purchase from our live store',
                    'Exchange bombs into your preferred currency (no extra fees)'
                ]
            ]);
        });
    }
}
