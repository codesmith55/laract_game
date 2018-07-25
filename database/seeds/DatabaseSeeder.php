<?php

use Illuminate\Database\Seeder;
//use PlayersTableSeeder;
//use UnitTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlayersTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(AugmentUnitTableSeeder::class);


    }
}
