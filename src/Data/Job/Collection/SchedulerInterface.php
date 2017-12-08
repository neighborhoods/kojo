<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Db\Model\CollectionInterface;

interface SchedulerInterface extends CollectionInterface
{
    public function setReferenceDateTime(\DateTime $dateTime): Scheduler;
}