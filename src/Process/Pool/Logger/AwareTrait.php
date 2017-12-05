<?php

namespace NHDS\Jobs\Process\Pool\Logger;

use NHDS\Jobs\Process\Pool\LoggerInterface;

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
}