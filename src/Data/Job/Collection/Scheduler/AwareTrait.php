<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection\Scheduler;

use Neighborhoods\Kojo\Data\Job\Collection\SchedulerInterface;

trait AwareTrait
{
    public function setSchedulerJobCollection(SchedulerInterface $schedulerCollection)
    {
        $this->_create(SchedulerInterface::class, $schedulerCollection);

        return $this;
    }

    protected function _getSchedulerJobCollection(): SchedulerInterface
    {
        return $this->_read(SchedulerInterface::class);
    }

    protected function _getSchedulerJobCollectionClone(): SchedulerInterface
    {
        return clone $this->_getSchedulerJobCollection();
    }
}