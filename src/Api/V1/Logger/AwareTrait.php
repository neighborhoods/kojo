<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Logger;

use Neighborhoods\Kojo\Api\V1\LoggerInterface;

trait AwareTrait
{
    public function setApiV1Logger(LoggerInterface $apiV1Logger): self
    {
        $this->_create(LoggerInterface::class, $apiV1Logger);

        return $this;
    }

    protected function _getApiV1Logger(): LoggerInterface
    {
        return $this->_read(LoggerInterface::class);
    }

    protected function _getApiV1LoggerClone(): LoggerInterface
    {
        return clone $this->_getApiV1Logger();
    }

    protected function _hasApiV1Logger(): bool
    {
        return $this->_exists(LoggerInterface::class);
    }

    protected function _unsetApiV1Logger(): self
    {
        $this->_delete(LoggerInterface::class);

        return $this;
    }
}