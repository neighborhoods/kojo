<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete;

use NHDS\Jobs\Data\Job\AbstractService;

class Success extends AbstractService implements SuccessInterface
{
    public function save(): SuccessInterface
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->requestCompleteSuccess();
        $this->_getJobStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }
}