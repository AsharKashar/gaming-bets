<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Model\Country;
use \App\Model\User;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('gender', User::GENDER)->after('currency_id')->nullable();
            $table->string('date_of_birth')->after('currency_id')->nullable();
            $table->unsignedBigInteger('country_id')->after('currency_id')->default(Country::getDefaultCountryId());
        });

        $countryDefaultId = optional(Country::firstWhere('code', 'USA'))->id;
        if ($countryDefaultId) {
            $countryDefaultId = Country::first()->id;
        }

        User::all()->each(function($user) use ($countryDefaultId) {
           $country = Country::firstWhere('name', $user->country);
           if ($country) {
               $user->update([
                   'country_id' => $country->id,
               ]);
           } else {
               $user->update([
                   'country_id' => $countryDefaultId,
               ]);
           }
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->foreign('country_id')->references('id')->on('countries');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('country');
        });

        User::all()->each(function($user) {
            $country = Country::find($user->country_id);
            $user->update([
                'country' => $country->name,
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn('gender');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('country_id');
        });
    }
}
