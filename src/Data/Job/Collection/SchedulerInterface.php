<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection;

use Neighborhoods\Kojo\Data\Job\CollectionInterface;

interface SchedulerInterface extends CollectionInterface
{
    public function setReferenceDateTime(\DateTime $dateTime): Scheduler;
}