<?php

namespace NHDS\Jobs\Worker;

use NHDS\Jobs\Data\Job;

class Locator implements LocatorInterface
{
    use Job\AwareTrait;

    public function getCallable(): callable
    {
        return [$this->_getJob()->getWorkerUri(), $this->_getJob()->getWorkerMethod()];
    }
}