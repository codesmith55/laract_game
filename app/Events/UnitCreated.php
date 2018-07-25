<?php
namespace laract\Events;

use Spatie\EventProjector\ShouldBeStored;

class UnitCreated implements ShouldBeStored
{
    /** @var array */
    public $unitAttributes;

    public function __construct(array $unitAttributes)
    {
        $this->unitAttributes = $unitAttributes;
    }
}