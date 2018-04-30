<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Scheduler;

use Neighborhoods\Kojo\Api\V1\Job\SchedulerInterface;

trait AwareTrait
{
    public function setApiV1JobScheduler(SchedulerInterface $apiV1JobScheduler): self
    {
        $this->_create(SchedulerInterface::class, $apiV1JobScheduler);

        return $this;
    }

    protected function _getApiV1JobScheduler(): SchedulerInterface
    {
        return $this->_read(SchedulerInterface::class);
    }

    protected function _getApiV1JobSchedulerClone(): SchedulerInterface
    {
        return clone $this->_getApiV1JobScheduler();
    }

    protected function _hasApiV1JobScheduler(): bool
    {
        return $this->_exists(SchedulerInterface::class);
    }

    protected function _unsetApiV1JobScheduler(): self
    {
        $this->_delete(SchedulerInterface::class);

        return $this;
    }
}