<?php
declare(strict_types=1);

namespace NHDS\Jobs\Scheduler\Time;

use NHDS\Jobs\Scheduler\TimeInterface;

trait AwareTrait
{
    public function setSchedulerTime(TimeInterface $schedulerTime)
    {
        $this->_create(TimeInterface::class, $schedulerTime);

        return $this;
    }

    protected function _getSchedulerTime(): TimeInterface
    {
        return $this->_read(TimeInterface::class);
    }

    protected function _getSchedulerTimeClone(): TimeInterface
    {
        return clone $this->_getSchedulerTime();
    }

    protected function _hasSchedulerTime(): bool
    {
        return $this->_exists(TimeInterface::class);
    }

    protected function _unsetSchedulerTime()
    {
        $this->_delete(TimeInterface::class);

        return $this;
    }
}