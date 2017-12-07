<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Time;

class Service implements ServiceInterface
{
    use Time\AwareTrait;
    use Job\AwareTrait;

    public function transitionJob($assignedStateUpdate, $nextStateRequestUpdate)
    {
        $referenceTime = $this->_getTime()->getNow();
        $this->_getJob()->setAssignedState($assignedStateUpdate);
        $this->_getJob()->setNextStateRequest($nextStateRequestUpdate);
        $this->_getJob()->setLastTransitionInDatetime($referenceTime);
        $this->_getJob()->setLastTransitionInMicroTime($referenceTime);
        $this->_getJob()->save();

        return $this;
    }

}