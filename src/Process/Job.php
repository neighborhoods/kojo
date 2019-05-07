<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Foreman;
use Neighborhoods\Kojo\Maintainer;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Scheduler;
use Neighborhoods\Kojo\Selector;
use Neighborhoods\Kojo\Environment;
use Throwable;

class Job extends Forked implements JobInterface
{
    use Foreman\AwareTrait;
    use Maintainer\AwareTrait;
    use Scheduler\AwareTrait;
    use Selector\AwareTrait;
    use Process\Pool\Factory\AwareTrait;
    use Environment\Memory\AwareTrait;

    protected function _run(): Forked
    {
        try {
            $this->_getProcessSignal()->setCanBufferSignals(false);
            $this->_getSelector()->setProcess($this);
            $this->_getMaintainer()->rescheduleCrashedJobs();
            $this->_getScheduler()->scheduleStaticJobs();
            $this->_getMaintainer()->updatePendingJobs();
            $this->_getMaintainer()->deleteCompletedJobs();
            $this->applyMemoryLimit();
            $this->_getForeman()->workWorker();
        } catch (Throwable $throwable) {
            $this->_getLogger()->critical($throwable->getMessage(), ['exception' => $throwable]);
            $this->_setOrReplaceExitCode(255);
        }

        return $this;
    }

    protected function applyMemoryLimit(): JobInterface
    {
        $processMaximumMemoryValue = $this->getEnvironmentMemory()->getWorkerMaximumMemoryValue();
        $this->_getLogger()->debug(sprintf('Applying memory limit of [%s] bytes.', $processMaximumMemoryValue));
        ini_set('memory_limit', $processMaximumMemoryValue);

        return $this;
    }
}
