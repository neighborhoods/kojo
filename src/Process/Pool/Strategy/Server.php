<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy;

use Neighborhoods\Kojo\Process\Forked\Exception;
use Neighborhoods\Kojo\Process\Pool\StrategyAbstract;
use Neighborhoods\Kojo\Process\Root;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Process\Pool\StrategyInterface;

class Server extends StrategyAbstract
{
    protected $_pausedListenerProcesses = [];

    public function childProcessExited(ProcessInterface $process): StrategyInterface
    {
        if ($process instanceof Root) {
            $this->_getProcessPool()->freeChildProcess($process->getProcessId());
            $rootProcess = $this->_getProcessCollection()->getProcessPrototypeClone($process->getTypeCode());
            try {
                $this->_getProcessPool()->addChildProcess($rootProcess);
            } catch (Exception $forkedException) {
                $this->_getLogger()->critical($forkedException->getMessage(), ['exception' => $forkedException]);
            }
        } else {
            $className = get_class($process);
            throw new \UnexpectedValueException("Unexpected process class[$className].");
        }

        return $this;
    }

    public function currentPendingChildExitsCompleted(): StrategyInterface
    {
        return $this;
    }

    public function receivedAlarm(): StrategyInterface
    {
        return $this;
    }

    public function initializePool(): StrategyInterface
    {
        $this->_getProcessCollection()->applyProcessPool($this->_getProcessPool());
        foreach ($this->_getProcessCollection() as $process) {
            try {
                $this->_getProcessPool()->addChildProcess($process);
            } catch (Exception $forkedException) {
                $this->_getLogger()->critical($forkedException->getMessage(), ['exception' => $forkedException]);
                $this->_getProcessPool()->getProcess()->exit();
            }
        }
        if ($this->_hasFillProcessTypeCode() && $this->canEnvironmentSustainAdditionalProcesses()) {
            while (!$this->_getProcessPool()->isFull()) {
                $fillProcessTypeCode = $this->_getFillProcessTypeCode();
                $fillProcess = $this->_getProcessCollection()->getProcessPrototypeClone($fillProcessTypeCode);
                try {
                    $this->_getProcessPool()->addChildProcess($fillProcess);
                } catch (Exception $forkedException) {
                    $this->_getLogger()->critical($forkedException->getMessage(), ['exception' => $forkedException]);
                    $this->_getProcessPool()->getProcess()->exit();
                }
            }
        }

        return $this;
    }
}
