<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger;

use Neighborhoods\Kojo\Process\Pool\LoggerInterface;

trait AwareTrait
{
    public function setLogger(LoggerInterface $logger)
    {
        $this->_create(LoggerInterface::class, $logger);

        return $this;
    }

    protected function _getLogger(): LoggerInterface
    {
        return $this->_read(LoggerInterface::class);
    }

    protected function _hasLogger(): bool
    {
        return $this->_exists(LoggerInterface::class);
    }

    protected function _unsetLogger()
    {
        $this->_delete(LoggerInterface::class);

        return $this;
    }
}