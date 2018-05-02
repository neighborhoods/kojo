<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Scheduler\Factory;

use Neighborhoods\Kojo\Api\V1\Job\Scheduler\FactoryInterface;

trait AwareTrait
{
    public function setApiV1JobSchedulerFactory(FactoryInterface $apiV1JobSchedulerFactory): self
    {
        $this->_create(FactoryInterface::class, $apiV1JobSchedulerFactory);

        return $this;
    }

    protected function _getApiV1JobSchedulerFactoryClone(): FactoryInterface
    {
        return clone $this->_getApiV1JobSchedulerFactory();
    }

    protected function _getApiV1JobSchedulerFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _hasApiV1JobSchedulerFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetApiV1JobSchedulerFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}