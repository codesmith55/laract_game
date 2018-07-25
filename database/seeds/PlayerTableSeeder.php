<?php

use Illuminate\Database\Seeder;
use laract\Player;

class PlayersTableSeeder extends Seeder
{
    /**
     *
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        // Create 50 player records
        for ($i = 0; $i < 8; $i++) {
            Player::create([
                'name' => $faker->name(),
                'level' => $faker->randomNumber(1),
                'status' => $faker->randomNumber(1),
            ]);
        }

    }
}

