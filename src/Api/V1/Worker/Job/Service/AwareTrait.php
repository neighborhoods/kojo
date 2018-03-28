<?php
declare(strict_types=1);

namespace NHDS\Jobs\Api\V1\Worker\Job\Service;

use NHDS\Jobs\Api\V1\Worker\Job\ServiceInterface;

trait AwareTrait
{
    /** @injected:runtime */
    public function setWorkerJobService(ServiceInterface $workerJobService): self
    {
        $this->_create(ServiceInterface::class, $workerJobService);

        return $this;
    }

    protected function _getWorkerJobService(): ServiceInterface
    {
        return $this->_read(ServiceInterface::class);
    }

    protected function _hasWorkerJobService(): bool
    {
        return $this->_exists(ServiceInterface::class);
    }

    protected function _unsetWorkerJobService(): self
    {
        $this->_delete(ServiceInterface::class);

        return $this;
    }
}