<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Foreman;
use Neighborhoods\Kojo\Worker\Bootstrap;
use Neighborhoods\Kojo\Scheduler;
use Neighborhoods\Kojo\Maintainer;
use Neighborhoods\Kojo\Selector;
use Neighborhoods\Kojo\Process;

class Job extends Forked implements JobInterface
{
    use Bootstrap\AwareTrait;
    use Foreman\AwareTrait;
    use Maintainer\AwareTrait;
    use Scheduler\AwareTrait;
    use Selector\AwareTrait;
    use Process\Pool\Factory\AwareTrait;

    protected function _run(): Forked
    {
        try{
            $this->_getSelector()->setProcess($this);
            $this->_getBootstrap()->instantiate();
            $this->_getMaintainer()->rescheduleCrashedJobs();
            $this->_getScheduler()->scheduleStaticJobs();
            $this->_getMaintainer()->updatePendingJobs();
            $this->_getMaintainer()->deleteCompletedJobs();
            $this->_getForeman()->workWorker();
        }catch(\Throwable $throwable){
            $this->_getLogger()->critical($throwable->getMessage());
            $this->_setOrReplaceExitCode(255);
        }

        return $this;
    }
}