<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection\ScheduleLimit;

use Neighborhoods\Kojo\Job\Collection\ScheduleLimitInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ScheduleLimitInterface
    {
        return clone $this->getDataJobCollectionScheduleLimit();
    }
}
