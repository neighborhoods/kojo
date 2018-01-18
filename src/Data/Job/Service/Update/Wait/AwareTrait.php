<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Wait;

use NHDS\Jobs\Data\Job\Service\Update\WaitInterface;

trait AwareTrait
{
    public function setJobServiceUpdateWait(WaitInterface $jobServiceUpdateWait)
    {
        $this->_create(WaitInterface::class, $jobServiceUpdateWait);

        return $this;
    }

    protected function _getJobServiceUpdateWait(): WaitInterface
    {
        return $this->_read(WaitInterface::class);
    }

    protected function _getJobServiceUpdateWaitClone(): WaitInterface
    {
        return clone $this->_getJobServiceUpdateWait();
    }
}