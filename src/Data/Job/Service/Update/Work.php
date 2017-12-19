<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\AbstractService;

class Work extends AbstractService implements WorkInterface
{
    public function save(): WorkInterface
    {
        $this->_getJobStateService()->requestWork();
        $this->_getJob()->save();

        return $this;
    }
}