<?php

namespace NHDS\Jobs\Process\Type;

use NHDS\Jobs\AbstractProcess;
use NHDS\Jobs\Foreman;
use NHDS\Jobs\Process\Type\Job\Bootstrap;
use NHDS\Jobs\Scheduler;
use NHDS\Jobs\Maintainer;

class Job extends AbstractProcess implements JobInterface
{
    use Bootstrap\AwareTrait;
    use Foreman\AwareTrait;
    use Maintainer\AwareTrait;
    use Scheduler\AwareTrait;

    protected function _run(): AbstractProcess
    {
        $this->_getMaintainer()->updatePendingJobs();
        $this->_getMaintainer()->rescheduleCrashedJobs();
        $this->_getScheduler()->schedule();
        sleep(30);
        $this->_getBootstrap()->instantiate();
        $this->_getForeman()->work();

        return $this;
    }
}