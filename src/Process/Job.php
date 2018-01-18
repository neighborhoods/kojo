<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\Foreman;
use NHDS\Jobs\Worker\Bootstrap;
use NHDS\Jobs\Scheduler;
use NHDS\Jobs\Maintainer;

class Job extends Forkable implements JobInterface
{
    use Bootstrap\AwareTrait;
    use Foreman\AwareTrait;
    use Maintainer\AwareTrait;
    use Scheduler\AwareTrait;

    protected function _run(): Forkable
    {
        $this->_getBootstrap()->instantiate();
        $this->_getMaintainer()->updatePendingJobs();
        $this->_getMaintainer()->rescheduleCrashedJobs();
        $this->_getMaintainer()->delete();
        $this->_getScheduler()->schedule();
        $this->_getForeman()->work();

        return $this;
    }
}