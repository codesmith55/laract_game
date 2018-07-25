<?php
namespace laract\Events;

use Spatie\EventProjector\ShouldBeStored;

class AccountDeleted implements ShouldBeStored
{
    /** @var string */
    public $unitUuid;

    public function __construct(string $unitUuid)
    {
        $this->unitUuid = $unitUuid;
    }
}