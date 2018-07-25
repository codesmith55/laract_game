<?php
namespace laract\Events;

use Spatie\EventProjector\ShouldBeStored;

class AugmentRemoved implements ShouldBeStored
{

    /** @var string */
    public $unitUuid;

    /** @var augment */
    public $augment;

    public function __construct(string $unitUuid, Augment $augment)
    {
        $this->unitUuid = $unitUuid;
        $this->augment = $augment;
    }
}