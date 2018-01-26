<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\Foreman;
use NHDS\Jobs\Worker\Bootstrap;
use NHDS\Jobs\Scheduler;
use NHDS\Jobs\Maintainer;
use NHDS\Jobs\Selector;

class Job extends Forkable implements JobInterface
{
    use Bootstrap\AwareTrait;
    use Foreman\AwareTrait;
    use Maintainer\AwareTrait;
    use Scheduler\AwareTrait;
    use Selector\AwareTrait;

    protected function _run(): Forkable
    {
        $this->_getSelector()->setProcess($this);
        $this->_getBootstrap()->instantiate();
        $this->_getMaintainer()->rescheduleCrashedJobs();
        $this->_getScheduler()->scheduleStaticJobs();
        $this->_getMaintainer()->updatePendingJobs();
        $this->_getMaintainer()->deleteCompletedJobs();
        $this->_getForeman()->workWorker();

        return $this;
    }
}