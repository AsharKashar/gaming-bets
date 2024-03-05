<?php

use App\Model\Team;
use App\Model\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->addTeamsForTesting(1);
        $this->call(PackaegesSeeder::class);
        $this->call(GameTypeBoxmatchSeeder::class);
     //   $this->call(localeSeederClass::class);

        $this->call(FaqCatagorySeederClass::class);
        $this->call(FaqQuestionSeeder::class);
        $this->call(UsersTableSeeder::class);
//        $this->call(UsersTableSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(AweberSeeder::class);
        $this->call(MonthlyTopSeeder::class);
        $this->call(BombPackagesSeeder::class);
        // $this->call(BombPackagesSeeder::class);
        // $this->call(BoxMatchRulesSeeder::class);
        $this->call(AdminMenuSeeder::class);
    }

    public function addTeamsForTesting ($tournament_id) {

        factory(Team::class, 2)->create()->each(function ($team)use($tournament_id) {
            DB::table('team_tournament')->insert([
                'team_id'       => $team->team_id,
                'tournament_id' => $tournament_id,
            ]);
            $team_id = $team->team_id;
            factory(User::class, 1)->create()->each(function ($user)use($team_id) {
                $faker = Faker::create();

                DB::table('team_user_relation')->insert([
                    'user_id'       => $user->id,
                    'team_id' => $team_id,
                    'checked_in' => 1,
                    'activision' => $faker->word(),
                ]);
            });

        });

        factory(Team::class, 2)->create()->each(function ($team)use($tournament_id) {
            DB::table('team_tournament')->insert([
                'team_id'       => $team->team_id,
                'tournament_id' => $tournament_id,
            ]);
            $team_id = $team->team_id;
            factory(User::class, 1)->create()->each(function ($user)use($team_id) {
                $faker = Faker::create();

                DB::table('team_user_relation')->insert([
                    'user_id'       => $user->id,
                    'team_id' => $team_id,
                    'checked_in' => 0,
                    'activision' => $faker->word(),
                ]);
            });

        });
    }




}

