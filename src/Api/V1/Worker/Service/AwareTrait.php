<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Worker\Service;

use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;

trait AwareTrait
{
    public function setApiV1WorkerService(ServiceInterface $workerService)
    {
        $this->_create(ServiceInterface::class, $workerService);

        return $this;
    }

    protected function _getApiV1WorkerService(): ServiceInterface
    {
        return $this->_read(ServiceInterface::class);
    }

    protected function _hasApiV1WorkerService(): bool
    {
        return $this->_exists(ServiceInterface::class);
    }

    protected function _unsetApiV1WorkerService(): self
    {
        $this->_delete(ServiceInterface::class);

        return $this;
    }
}