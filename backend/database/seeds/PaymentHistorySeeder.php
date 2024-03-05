<?php

use App\Model\BombHistory;
use Illuminate\Database\Seeder;
use App\Model\PaymentHistory;
use App\Model\User;
use App\Model\BombPackage;
use App\Model\Tournament;

class PaymentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bombPackages = BombPackage::all();
        $tournament = Tournament::all();
        if ($tournament->count() === 0) {
            return;
        }
        if (!app()->isProduction()) {
            if (!User::where('email', 'tester@bangergames.com')->exists()) {
                DB::table('users')->insert(
                    [
                        'name' => 'Tester',
                        'email' => 'tester@bangergames.com',
                        'username' => 'tester',
                        'user_type' => 'user',
                        'email_verified_at' => now(),
                        'password' => Hash::make('q1w2e3r4@'),
                        'currency_id' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'image' => "/black/img/default-avatar.png",
                    ]
                );
            }
            $user = User::where('email', 'tester@bangergames.com')->first();


            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $stripe_customer = \Stripe\Customer::create(
                [
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            );

            $user->update([
                'stripe_id' => $stripe_customer->id,
            ]);

            // insert random payment history for demo user
            for ($x = 0; $x <= 10; $x++) {
                /** @var BombPackage $randomBombPackage */
                $randomBombPackage = $bombPackages[array_rand($bombPackages->toArray())];
                $randomTournament = $tournament[array_rand($tournament->toArray())];
                PaymentHistory::create([
                    "user_id" => $user->id,
                    "pay" => $randomBombPackage->price,
                ]);

                BombHistory::create([
                    'user_id' => $user->id,
                    'bombs_paid' => $randomBombPackage->price,
                    'bombs_reward' => $randomBombPackage->free_bombs ?? 0,
                    'bombs_free' => random_int(0, 10),
                    'type' => BombHistory::TYPES['tournament'],
                     'pay' => [
                         BombHistory::TYPES['tournament']  => $randomTournament->id
                     ],
                ]);
            }
        }
    }
}
