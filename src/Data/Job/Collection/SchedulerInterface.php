<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\Job\CollectionInterface;

interface SchedulerInterface extends CollectionInterface
{
    public function setReferenceDateTime(\DateTime $dateTime): Scheduler;
}