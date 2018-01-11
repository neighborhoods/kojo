<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete\Failed;

use NHDS\Jobs\Data\Job\Service\Update\Complete\FailedInterface;

trait AwareTrait
{
    public function setUpdateCompleteFailed(FailedInterface $updateCompleteFailed)
    {
        $this->_create(FailedInterface::class, $updateCompleteFailed);

        return $this;
    }

    protected function _getUpdateCompleteFailed(): FailedInterface
    {
        return $this->_read(FailedInterface::class);
    }

    protected function _getUpdateCompleteFailedClone(): FailedInterface
    {
        return clone $this->_getUpdateCompleteFailed();
    }
}