<?php

namespace NHDS\Jobs\Worker;

use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Crud;

class Locator implements LocatorInterface
{
    use Job\AwareTrait;
    use Crud\AwareTrait;

    public function getCallable(): callable
    {
        $class = $this->_getJob()->getWorkerUri();
        $object = new $class;

        return [$object, $this->_getJob()->getWorkerMethod()];
    }
}