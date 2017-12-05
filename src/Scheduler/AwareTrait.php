<?php

namespace NHDS\Jobs\Scheduler;

use NHDS\Jobs\SchedulerInterface;

trait AwareTrait
{
    public function setScheduler(SchedulerInterface $scheduler)
    {
        $this->_create(SchedulerInterface::class, $scheduler);

        return $this;
    }

    protected function _getScheduler(): SchedulerInterface
    {
        return $this->_read(SchedulerInterface::class);
    }
}