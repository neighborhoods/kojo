<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\AbstractService;

class Crash extends AbstractService implements PanicInterface
{
    public function save(): PanicInterface
    {
        $this->_getJobStateService()->requestCrashed();
        $this->_getJob()->save();

        return $this;
    }
}