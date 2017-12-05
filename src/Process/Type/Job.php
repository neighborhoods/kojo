<?php

namespace NHDS\Jobs\Process\Type;

use NHDS\Jobs\AbstractProcess;
use NHDS\Jobs\Foreman;
use NHDS\Jobs\Process\Type\Job\Bootstrap;

class Job extends AbstractProcess implements JobInterface
{
    use Bootstrap\AwareTrait;
    use Foreman\AwareTrait;

    protected function _run(): AbstractProcess
    {
        sleep(30);
        $this->_getBootstrap()->instantiate();
        $this->_getForeman()->work();

        return $this;
    }
}