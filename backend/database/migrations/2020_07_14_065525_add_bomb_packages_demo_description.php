<?php

use App\Model\BombPackage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBombPackagesDemoDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $description = [
            'Enter cash prize tournaments',
            'Purchase from our live store',
            'Exchange bombs into your preferred currency (no extra fees)'
        ];
        $bombPackages = BombPackage::all();
        foreach ($bombPackages as $bombPackage) {
            $bombPackage->setDescriptionAttribute($description);
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
