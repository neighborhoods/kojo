<?php

namespace NHDS\Jobs\Data\Job\Collection\ScheduleLimit;

use NHDS\Jobs\Data\Job\Collection\ScheduleLimitInterface;

trait AwareTrait
{
    public function setScheduleLimitJobCollection(ScheduleLimitInterface $scheduleLimitJobCollection)
    {
        $this->_create(ScheduleLimitInterface::class, $scheduleLimitJobCollection);

        return $this;
    }

    protected function _getScheduleLimitJobCollection(): ScheduleLimitInterface
    {
        if (!$this->_exists(ScheduleLimitInterface::class . '_INITIALIZED')) {
            /** @var ScheduleLimitInterface $scheduleLimitJobCollection */
            $scheduleLimitJobCollection = $this->_read(ScheduleLimitInterface::class);
            $scheduleLimitJobCollection->setJobType($this->_getJobType());
            $this->_create(ScheduleLimitInterface::class . '_INITIALIZED', true);
        }

        return $this->_read(ScheduleLimitInterface::class);
    }

    protected function _getScheduleLimitJobCollectionClone(): ScheduleLimitInterface
    {
        return clone $this->_getScheduleLimitJobCollection();
    }
}