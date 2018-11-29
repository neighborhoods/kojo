<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy;

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
            $this->_getProcessPool()->addChildProcess($rootProcess);
        } else {
            $className = get_class($process);
            throw new \UnexpectedValueException("Unexpected process class[$className].");
        }

        return $this;
    }

    public function currentPendingChildExitsCompleted(): StrategyInterface
    {
        if (!$this->_getProcessPool()->hasAlarm()) {
            $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
        }

        return $this;
    }

    public function receivedAlarm(): StrategyInterface
    {
        if (!$this->_getProcessPool()->isFull() && $this->_getProcessPool()->canEnvironmentSustainAdditionProcesses()) {
            $alarmProcessTypeCode = $this->_getAlarmProcessTypeCode();
            $alarmProcess = $this->_getProcessCollection()->getProcessPrototypeClone($alarmProcessTypeCode);
            $this->_getProcessPool()->addChildProcess($alarmProcess);
        }
        if (!$this->_getProcessPool()->hasAlarm()) {
            $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
        }

        return $this;
    }

    public function initializePool(): StrategyInterface
    {
        $this->_getProcessPool()->setAlarm($this->getMaxAlarmTime());
        $this->_getProcessCollection()->applyProcessPool($this->_getProcessPool());
        foreach ($this->_getProcessCollection() as $process) {
            $this->_getProcessPool()->addChildProcess($process);
        }
        if ($this->_hasFillProcessTypeCode() && $this->_getProcessPool()->canEnvironmentSustainAdditionProcesses()) {
            while (!$this->_getProcessPool()->isFull()) {
                $fillProcessTypeCode = $this->_getFillProcessTypeCode();
                $fillProcess = $this->_getProcessCollection()->getProcessPrototypeClone($fillProcessTypeCode);
                $this->_getProcessPool()->addChildProcess($fillProcess);
            }
        }

        return $this;
    }
}
