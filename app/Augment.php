<?php

namespace laract;

use Illuminate\Database\Eloquent\Model;

class Augment extends Model
{
    //
    public $type;
    public $level;
    public $cost;//?
    public $initial;//effect type//bonus for first element use
    public $convert;//effect type//bonus for each element use
    public $stat_adjust;//effect type
    public $monster_hp;

    public static function createRandomAugment()
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
            'trigger' => 'initial',
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
        //$this->augments()->get()->attach($newAugment->id);
        return $newAugment;
    }
}
