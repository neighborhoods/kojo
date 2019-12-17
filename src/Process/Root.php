<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Semaphore;

class Root extends Forked
{
    public const TYPE_CODE = 'root';
    protected const SINGLETON_PROCESSES = [
        JobStateChangelogProcessor::TYPE_CODE
    ];

    use Semaphore\Resource\Factory\AwareTrait;
    use Collection\AwareTrait;

    public function __construct()
    {
        $this->setTypeCode(self::TYPE_CODE);
    }

    protected function _run(): Forked
    {
        $this->_getProcessCollection()->applyProcessPool($this->_getProcessPool());

        while (true) {
            $this->getProcessSignalDispatcher()->processBufferedSignals();
            $this->pollSingletonProcesses();
            sleep(1);
        }

        return $this;
    }

    protected function pollSingletonProcesses() : Root
    {
        if ($this->_getProcessPool()->shouldEnvironmentCreateAdditionProcesses()) {
            foreach (self::SINGLETON_PROCESSES as $singletonType) {
                $semaphoreResource = $this->_getSemaphoreResource($singletonType);

                // soft test the lock to spawn a process
                // that process will go on to attempt to actually acquire the global mutex
                if ($semaphoreResource->testLock()) {
                    try {
                        $process = $this->_getProcessCollection()->getProcessPrototypeClone($singletonType);
                        $this->_getProcessPool()->addChildProcess($process);
                    } catch (Forked\Exception $forkedException) {
                        // this is fine, another execution environment will spawn this process
                        // TODO: consider breaking here to stop attempting to spawn other singletons
                        $this->_getLogger()->debug($forkedException->getMessage(), ['exception' => $forkedException]);
                    }
                }
            }
        }

        return $this;
    }
}
