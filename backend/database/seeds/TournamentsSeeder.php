<?php

use App\Model\EntryFee;
use App\Model\Frequency;
use App\Model\Game;
use App\Model\Region;
use App\Model\Status;
use App\Model\Tournament;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TournamentsSeeder extends Seeder
{

    /**
     * @return array
     */
    private function randomFeatured()
    {
        $numbers = range(0, 1);
        shuffle($numbers);
        return $numbers[0];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        if (app()->isProduction()) {
            return;
        }

        $games = Game::all()->whereNotIn('name', ['APEX', 'Hyper Scape']);

        for($days=0;$days<15;$days++)
        {
            foreach ($games as $game)
            {
                $gameModes = $game->gameModes;
                foreach($gameModes as $gameMode)
                {
                    $faker = Faker::create();

                    $tournamentName = $game->name;
                    $image = $game->image_public_url;
                    $today = Carbon::now();
                    $date = $today->addDays($days);
                    $just_date = $date->format('Y-m-d');

                    $randomHour=rand(0,23);
                    $randomMinute=rand(0,59);

                    $start= new Carbon($just_date.' '.$randomHour.':'.$randomMinute);
                    $end = Carbon::parse($start)->addHour(3);
                    $reg_end = Carbon::parse($start)->subHour(1);

                    $tournamentSize = $game->tournamentSizes()->inRandomOrder()->first();
                    $gameType = $gameMode->gameTypes()->inRandomOrder()->first();

                    $tournament = Tournament::create([
                        'name'                  => $tournamentName.' Tournament',
                        'description'           => $faker->paragraph,
                        'image'                 => $image,
                        'overview'              => $faker->paragraph,
                        'hosted_by'             => $faker->name,
                        'tournament_size_id'    => $tournamentSize->id,
                        'entry_fee_id'          => EntryFee::inRandomOrder()->first()->id,
                        'status_id'             => Status::where('group','tournament')->inRandomOrder()->first()->id,
                        'frequency_id'          => Frequency::inRandomOrder()->first()->id,
                        'game_mode_id'          => $gameMode->id,
                        'game_id'               => $game->id,
                        'game_type_id'          => $gameType->id,
                        'featured'              => $this->randomFeatured(),
                        'check_in'              => 10,
                        'kickoff_in'            => '5',
                        'start_at'              => $start,
                        'end_at'                => $end,
                        'reg_start_at'          => now(),
                        'reg_end_at'            => $reg_end,
                    ]);

                    $tournament->platforms()->sync([$game->gamePlatforms()->inRandomOrder()->first()->id]);
                    $tournament->regions()->sync([Region::inRandomOrder()->first()->id]);
                }
            }
        }

    }
}
