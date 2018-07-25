<?php
namespace laract\Events;

use laract\Augment;
use Spatie\EventProjector\ShouldBeStored;

class AugmentAdded implements ShouldBeStored
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