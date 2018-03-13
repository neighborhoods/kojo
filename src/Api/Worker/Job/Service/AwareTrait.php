<?php
declare(strict_types=1);

namespace NHDS\Jobs\Api\User\Job\Service;

use NHDS\Jobs\Api\Worker\Job\ServiceInterface;

trait AwareTrait
{
    public function setApiUserJobService(ServiceInterface $apiJobService): self
    {
        $this->_create(ServiceInterface::class, $apiJobService);

        return $this;
    }

    protected function _getApiUserJobService(): ServiceInterface
    {
        return $this->_read(ServiceInterface::class);
    }

    protected function _getApiUserJobServiceClone(): ServiceInterface
    {
        return clone $this->_getApiUserJobService();
    }

    protected function _hasApiUserJobService(): bool
    {
        return $this->_exists(ServiceInterface::class);
    }

    protected function _unsetApiUserJobService(): self
    {
        $this->_delete(ServiceInterface::class);

        return $this;
    }
}