<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Crash;

use NHDS\Jobs\Data\Job\Service\Update\CrashInterface;

trait AwareTrait
{
    public function setJobServiceUpdateCrash(CrashInterface $jobServiceUpdateCrash)
    {
        $this->_create(CrashInterface::class, $jobServiceUpdateCrash);

        return $this;
    }

    protected function _getJobServiceUpdateCrash(): CrashInterface
    {
        return $this->_read(CrashInterface::class);
    }

    protected function _getJobServiceUpdateCrashClone(): CrashInterface
    {
        return clone $this->_getJobServiceUpdateCrash();
    }
}