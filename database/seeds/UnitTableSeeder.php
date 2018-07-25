<?php

use Illuminate\Database\Seeder;
use laract\Effect;
use laract\Augment;
use laract\Unit;


class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    function run()
    {
        $faker = \Faker\Factory::create();

        // Create 50 player records
        for ($i = 0; $i < 5; $i++) {
            $params = [];//was obj, now array
            $params["isHero"] = true;
            $params["name"] = $faker->name;
            $params["level"] = mt_rand(2,4);

            $params["stat_evocation"] = 2;//mt_rand(2, 2),
            $params["stat_abjuration"] = 2;//mt_rand(2, 2),
            $params["stat_divination"] = 2;//mt_rand(2, 2),
            $params["stat_transmutation"] = 2;//mt_rand(2, 2),
            $params["stat_symbiosis"] = 2;//mt_rand(2, 2),

            $params["convert_evocation"] = "";
            $params["convert_abjuration"] = "";
            $params["convert_divination"] = "";
            $params["convert_transmutation"] = "";
            $params["convert_symbiosis"] = "";
            $params["initial_evocation"] = "";
            $params["initial_abjuration"] = "";
            $params["initial_divination"] = "";
            $params["initial_transmutation"] = "";
            $params["initial_symbiosis"] = "";
            $newUnit = Unit::createWithAttributes($params);
        }
    }
}
