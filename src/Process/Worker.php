<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Foreman;
use Neighborhoods\Kojo\Scheduler;
use Neighborhoods\Kojo\Maintainer;
use Neighborhoods\Kojo\Selector;

class Worker extends Forked implements WorkerInterface
{
    use Foreman\AwareTrait;
    use Maintainer\AwareTrait;
    use Scheduler\AwareTrait;
    use Selector\AwareTrait;

    protected function run(): Forked
    {
        try{
            $this->getSelector()->setProcess($this);
            $this->getMaintainer()->rescheduleCrashedJobs();
            $this->getScheduler()->scheduleStaticJobs();
            $this->getMaintainer()->updatePendingJobs();
            $this->getMaintainer()->deleteCompletedJobs();
            $this->getForeman()->workWorker();
        }catch(\Throwable $throwable){
            $this->getLogger()->critical($throwable->getMessage());
            $this->setOrReplaceExitCode(255);
        }

        return $this;
    }
}