<?php

namespace laract;

use Illuminate\Database\Eloquent\Model;

use Ramsey\Uuid\Uuid;

use laract\Events\UnitCreated;
use laract\Events\AugmentAdded;
use laract\Events\AugmentRemoved;
use laract\Events\UnitDeleted;
use laract\Augment;


class Unit extends Model
{
    //
    public $stat_evocation = 0;
    public $stat_abjuration = 0;
    public $stat_divination = 0;
    public $stat_transmutation = 0;
    public $stat_symbiosis = 0;

    public $convert_evocation = [];
    public $convert_abjuration = [];
    public $convert_divination = [];
    public $convert_transmutation = [];
    public $convert_symbiosis = [];

    public $initial_evocation = [];
    public $initial_abjuration = [];
    public $initial_divination = [];
    public $initial_transmutation = [];
    public $initial_symbiosis = [];

    //add getters and setters to each of the values.
    //Series of \Effects added from Augments and such, pushed in. Rendered on use. I GOT THIS.

    public $isHero = false;

    public $level = 0;

    public function augments(){
        return $this->belongsToMany('laract\Augment');
    }
    public static function createWithAttributes(array $attributes): Unit
    {

        $attributes['uuid'] = (string) Uuid::uuid4();

        /*
         * The Unit will be created inside this event using the generated uuid.
         */
        event(new UnitCreated($attributes));

        /*
         * The uuid will be used the retrieve the created Unit.
         */
        return static::uuid($attributes['uuid']);
    }

    public function addAugment(Augment $augment)
    {

        event(new AugmentAdded($this->uuid, $augment));
    }

    public function removeAugment(Augment $augment)
    {
        event(new AugmentRemoved($this->uuid, $augment));
    }

    public function delete()
    {
        event(new UnitDeleted($this->uuid));
    }

    /*
     * A helper method to quickly retrieve an Unit by uuid.
     */
    public static function uuid(string $uuid): ?Unit
    {
        return static::where('uuid', $uuid)->first();
    }



    public static function createRandom($params)
    {
        $faker = \Faker\Factory::create();

        $default = [];
        $default["name"] = $faker->name;
        $default["isHero"] = 0;
        $default["level"] = mt_rand(4, 7);
        $default["stat_evocation"] = 2;//mt_rand(2, 2),
        $default["stat_abjuration"] = 2;//mt_rand(2, 2),
        $default["stat_divination"] = 2;//mt_rand(2, 2),
        $default["stat_transmutation"] = 2;//mt_rand(2, 2),
        $default["stat_symbiosis"] = 2;//mt_rand(2, 2),

        $defAugments = [];
        $defAugments["evocation"] = [];
        $defAugments["abjuration"] = [];
        $defAugments["divination"] = [];
        $defAugments["transmutation"] = [];
        $defAugments["symbiosis"] = [];
        $default["augments"] = $defAugments;

        $default["convert_evocation"] = "";
        $default["convert_abjuration"] = "";
        $default["convert_divination"] = "";
        $default["convert_transmutation"] = "";
        $default["convert_symbiosis"] = "";
        $default["initial_evocation"] = "";
        $default["initial_abjuration"] = "";
        $default["initial_divination"] = "";
        $default["initial_transmutation"] = "";
        $default["initial_symbiosis"] = "";

        foreach($params as $key => $value)
        {
            $default[$key] = $value;
        }

        $newUnit = Unit::create($default);

        for ($i = 0; $i < $newUnit["level"]; $i++)//for every level, augment
        {
            $newUnit->addAugment(Augment::createRandomAugment());
        }
        $newUnit = Unit::createWithAttributes($params);

        //$newUnit->"convert_evocation" = [];
        return $newUnit;
    }
    public function addRandomAugment()
    {
        $type = "stat_evocation";
        $stat_adjust = round((mt_rand(0, 10) / 20) - .2, 2);
        $stat = mt_rand(1, 5);
        if($stat == 1)
            $type = "evocation";
        if($stat == 2)
            $type = "abjuration";
        if($stat == 3)
            $type = "divination";
        if($stat == 4)
            $type = "transmutation";
        if($stat == 5)
            $type = "symbiosis";

        $atkDef = mt_rand(0, 2);
        $output = "Attack";
        if($atkDef == 2)//2/3 atk to def
            $output = "Defense";

        $initial = Effect::create([
            'trigger' => 'convert',
            'input' => $type,
            'type' => $output,
            'output' => mt_rand(1, 3),
        ]);
        $convert = Effect::create([
            'trigger' => 'convert',
            'input' => $type,
            'type' => $output,
            'output' => 1,
        ]);

        $newAugment = Augment::create([
            'type' => $type,
            'level' => 1,
            'cost' => 1,
            'initial' => $initial,//effect type//bonus for first element use
            'convert' => $convert,//effect type//bonus for each element use
            'stat_adjust' => $stat_adjust,//effect type
        ]);
    }


    public function applyAugment($augment)
    {
        //$this["augment_" . $augment["type"]] = $augment->id; //Current augment is new augment
        $augment__stat_adjust = $augment["stat_adjust"];
        $augmentType = $augment["type"];
        if($augment__stat_adjust != null)
        {
            $currentStat = $this["stat_".$augment["type"]];
            $this["stat_".$augmentType] = Round(($currentStat+$augment__stat_adjust), 2);

        }

/*        $existingAugmentsString = $this["augments"];
        $existingAugmentsArray = json_decode($existingAugmentsString);
        $existingAugmentsArray[$augment["initial"]["trigger"]][$augmentType] = [$augment["output"]]
  */

        $existingInitialString = $this["initial_".$augmentType];
        $existingInitialArray = json_decode($existingInitialString);
        $initialEffect = $augment["initial"];
        $existingInitialArray[] = array(
            $initialEffect["trigger"],
            $initialEffect["input"],
            $initialEffect["type"],
            $initialEffect["output"]
        );
        $this["initial_".$augmentType] = json_encode($existingInitialArray);

        $existingConvertString = $this["convert_".$augmentType];
        $existingConvertArray = json_decode($existingConvertString);
        $convertEffect = $augment["convert"];
        $existingConvertArray[] = array(
            $convertEffect["trigger"],
            $convertEffect["input"],
            $convertEffect["type"],
            $convertEffect["output"]
        );
        $this["convert_".$augmentType] = json_encode($existingConvertArray);


        //array_push($this["convert_".$augmentType], ($augment->convert));
        //array_push($this["initial_".$augmentType], ($augment->initial));
        //echo $this["initial_".$augmentType] . "\n\n";
        $this->save();

    }
}
