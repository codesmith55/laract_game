<?php

namespace laract\Projectors;

use laract\Unit;
use laract\Events\UnitCreated;
use laract\Events\UnitDeleted;
use laract\Events\AugmentAdded;
use laract\Events\AugmentRemoved;
use Spatie\EventProjector\Models\StoredEvent;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;
use laract\Augment;


class UnitProjector implements Projector
{
    use ProjectsEvents;

    /*
     * Here you can specify which event should trigger which method.
     */
    public $handlesEvents = [
        UnitCreated::class      => 'onUnitCreated',
        AugmentAdded::class     => 'onAugmentAdded',
        AugmentRemoved::class   => 'onAugmentRemoved',
        UnitDeleted::class      => 'onUnitDeleted',
    ];

    public function onUnitCreated(UnitCreated $event)
    {
        $unitCreated = Unit::create($event->unitAttributes);
        for($i = 0; $i <  $unitCreated["level"]; $i++)
        {
            $unitCreated->applyAugment(Augment::createRandomAugment());
        }
        //$unitCreated->addAugment(Augment::createRandomAugment());
    }

    public function onAugmentAdded(AugmentAdded $event)
    {
        $unit = Unit::uuid($event->unitUuid);
        $unit->applyAugment(Augment::createRandomAugment());
//        $augment = $event->augment;
        //      $unit->augments()->attach($augment->id);
        //    $unit->applyAugment($augment);

        //$unit->balance += $event->amount;

        $unit->save();
    }
    public function addAugment(Unit $unit, Augment $augment)
    {

    }

    public function onAugmentRemoved(AugmentRemoved $event)
    {
        $unit = Unit::uuid($event->unitUuid);

        $unit->balance -= $event->amount;

        $unit->save();

        if ($unit->balance >= 0) {
            $this->broke_mail_sent = false;
        }
    }

    public function onUnitDeleted(UnitDeleted $event)
    {
        Unit::uuid($event->unitUuid)->delete();
    }
    /*
    public function onEventHappened(EventHappended $event)
    {

    }
    */
}