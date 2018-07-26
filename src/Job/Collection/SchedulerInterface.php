<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection;

use Neighborhoods\Kojo\Job\CollectionInterface;

interface SchedulerInterface extends CollectionInterface
{
    public function setReferenceDateTime(\DateTime $dateTime): Scheduler;
}