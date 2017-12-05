<?php

namespace NHDS\Jobs\Data\Status;

use NHDS\Jobs\Data\StatusInterface;

trait AwareTrait
{
    public function setStatus(StatusInterface $status)
    {
        $this->_create(StatusInterface::class, $status);

        return $this;
    }

    protected function _getStatus(): StatusInterface
    {
        return $this->_read(StatusInterface::class);
    }

    protected function _getStatusClone(): StatusInterface
    {
        return clone $this->_getStatus();
    }
}