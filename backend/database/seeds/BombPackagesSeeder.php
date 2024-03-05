<?php

use Illuminate\Database\Seeder;
use \App\Model\BombPackage;
class BombPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (BombPackage::all()->isNotEmpty()) {
            return;
        }

        $description = [
            'Enter cash prize tournaments',
            'Purchase from our live store',
            'Exchange bombs into your preferred currency (no extra fees)'
        ];

        BombPackage::create([
            'bombs'       => 10,
            'free_bombs'      => 0,
            'price'      => 10,
            'created_at' => now(),
            'updated_at' => now(),
            'description' => $description
        ]);

        BombPackage::create([
            'bombs'       => 50,
            'free_bombs'      => 2,
            'price'      => 50,
            'created_at' => now(),
            'updated_at' => now(),
            'description' => $description
        ]);

        BombPackage::create([
            'bombs'       => 100,
            'free_bombs'      => 5,
            'price'      => 100,
            'created_at' => now(),
            'updated_at' => now(),
            'description' => $description
        ]);

        BombPackage::create([
            'bombs'       => 500,
            'free_bombs'      => 10,
            'price'      => 500,
            'created_at' => now(),
            'updated_at' => now(),
            'description' => $description
        ]);

        BombPackage::create([
            'bombs'       => 1000,
            'free_bombs'      => 20,
            'price'      => 1000,
            'created_at' => now(),
            'updated_at' => now(),
            'description' => $description
        ]);

    }
}
