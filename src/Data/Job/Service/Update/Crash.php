<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\AbstractService;

class Crash extends AbstractService implements CrashInterface
{
    public function save(): CrashInterface
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->requestCrashed();
        $this->_getJob()->save();

        return $this;
    }
}