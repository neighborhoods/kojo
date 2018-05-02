<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Type\Collection\Scheduler;

use Neighborhoods\Kojo\Data\Job\Type\Collection\SchedulerInterface;

trait AwareTrait
{
    public function setSchedulerJobTypeCollection(SchedulerInterface $jobTypeSchedulerCollection)
    {
        $this->_create(SchedulerInterface::class, $jobTypeSchedulerCollection);

        return $this;
    }

    protected function _getSchedulerJobTypeCollection(): SchedulerInterface
    {
        return $this->_read(SchedulerInterface::class);
    }

    protected function _getSchedulerJobTypeCollectionClone(): SchedulerInterface
    {
        return clone $this->_getSchedulerJobTypeCollection();
    }
}