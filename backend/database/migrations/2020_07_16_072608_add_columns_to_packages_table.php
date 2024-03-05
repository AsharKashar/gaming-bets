<?php

use App\Model\Package;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->integer('daily_save')->after('monthly_allowed')->default(0);
            $table->integer('money_win_chance')->after('monthly_allowed')->default(0);
            $table->integer('wagers')->after('monthly_allowed')->default(0);
        });

        $packages = Package::all();
        $demoData = [
            'daily_save' => 22,
            'money_win_chance' => 35,
            'wagers' => 25,
        ];

        foreach ($packages as $package) {
            $package->update($demoData);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('daily_save');
            $table->dropColumn('money_win_chance');
            $table->dropColumn('wagers');
        });
    }
}
