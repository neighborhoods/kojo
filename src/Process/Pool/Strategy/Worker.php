<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy;

use Neighborhoods\Kojo\Process\Pool\StrategyAbstract;
use Neighborhoods\Kojo\Process\Pool\StrategyInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Process\ListenerInterface;

class Worker extends StrategyAbstract
{
    protected $_pausedListenerProcesses = [];

    public function childProcessExited(ProcessInterface $process): StrategyInterface
    {
        if ($process instanceof ListenerInterface) {
            $this->_listenerProcessExited($process);
        } else {
            $className = get_class($process);
            throw new \UnexpectedValueException("Unexpected process class[$className].");
        }

        return $this;
    }

    protected function _listenerProcessExited(ListenerInterface $listenerProcess): StrategyInterface
    {
        while ($listenerProcess->hasMessages()) {
            $listenerProcess->processMessages();
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
            $this->_getProcessPool()->addChildProcess($process);
        }
        if ($this->_hasFillProcessTypeCode()) {
            while (!$this->_getProcessPool()->isFull()) {
                $fillProcessTypeCode = $this->_getFillProcessTypeCode();
                $fillProcess = $this->_getProcessCollection()->getProcessPrototypeClone($fillProcessTypeCode);
                $this->_getProcessPool()->addChildProcess($fillProcess);
            }
        }

        return $this;
    }
}
