<?php

namespace NHDS\Jobs\Process\Type;

use NHDS\Jobs\ProcessAbstract;
use NHDS\Jobs\Foreman;
use NHDS\Jobs\Worker\Bootstrap;
use NHDS\Jobs\Scheduler;
use NHDS\Jobs\Maintainer;

class Job extends ProcessAbstract implements JobInterface
{
    use Bootstrap\AwareTrait;
    use Foreman\AwareTrait;
    use Maintainer\AwareTrait;
    use Scheduler\AwareTrait;

    protected function _run(): ProcessAbstract
    {
        $this->_getBootstrap()->instantiate();
        $this->_getMaintainer()->updatePendingJobs();
        $this->_getMaintainer()->rescheduleCrashedJobs();
        $this->_getScheduler()->schedule();
        $this->_getForeman()->work();

        return $this;
    }
}