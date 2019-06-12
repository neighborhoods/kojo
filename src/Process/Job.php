<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Foreman;
use Neighborhoods\Kojo\Maintainer;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Scheduler;
use Neighborhoods\Kojo\Selector;
use Throwable;

class Job extends Forked implements JobInterface
{
    use Foreman\AwareTrait;
    use Maintainer\AwareTrait;
    use Scheduler\AwareTrait;
    use Selector\AwareTrait;
    use Process\Pool\Factory\AwareTrait;

    protected function _run(): Forked
    {
        try {
            $this->_getSelector()->setProcess($this);
            $this->_getMaintainer()->rescheduleCrashedJobs();
            $this->_getScheduler()->scheduleStaticJobs();
            $this->_getMaintainer()->updatePendingJobs();
            $this->_getMaintainer()->deleteCompletedJobs();
            $this->_getForeman()->workWorker();
        } catch (Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), ['exception' => $throwable]);
            $this->_setOrReplaceExitCode(255);
        }

        return $this;
    }

    protected function _registerSignalHandlers(): ProcessInterface
    {
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGCHLD, $this, false);
        $this->getProcessSignalDispatcher()->ignoreSignal(SIGALRM);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGTERM, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGINT, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGHUP, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGQUIT, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGABRT, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGUSR1, $this, false);
        $this->_getLogger()->debug('Registered signal handlers.');

        return $this;
    }
}
