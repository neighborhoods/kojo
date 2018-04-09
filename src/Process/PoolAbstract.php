<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;

abstract class PoolAbstract implements PoolInterface
{
    use Defensive\AwareTrait;
    use Process\Pool\Logger\AwareTrait;
    use Process\Pool\Strategy\AwareTrait;
    use Process\AwareTrait;
    use Process\Signal\AwareTrait;

    abstract protected function _childExitSignal(InformationInterface $information): PoolInterface;

    public function hasAlarm(): bool
    {
        $hasAlarm = false;
        if (($seconds = pcntl_alarm(0)) > 0) {
            $hasAlarm = true;
        }
        pcntl_alarm($seconds);

        return $hasAlarm;
    }

    public function setAlarm(int $seconds): PoolInterface
    {
        $this->_getLogger()->info('Setting alarm for [' . $seconds . '] seconds.');
        pcntl_alarm($seconds);

        return $this;
    }

    public function isEmpty(): bool
    {
        return (bool)($this->getCountOfChildProcesses() === 0);
    }

    public function isFull(): bool
    {
        if ((float)current(sys_getloadavg()) > $this->_getProcessPoolStrategy()->getMaximumLoadAverage()) {
            $isFull = true;
        }else {
            $maxChildProcesses = $this->_getProcessPoolStrategy()->getMaxChildProcesses();
            $isFull = (bool)($this->getCountOfChildProcesses() >= $maxChildProcesses);
        }

        return $isFull;
    }

    protected function _initialize(): PoolInterface
    {
        $this->_getProcessPoolStrategy()->initializePool();

        return $this;
    }

    protected function _alarmSignal(InformationInterface $information): PoolInterface
    {
        $this->_getProcessPoolStrategy()->receivedAlarm();

        return $this;
    }

    protected function _validateAlarm(): PoolInterface
    {
        $alarmValue = pcntl_alarm(0);
        if ($this->isEmpty()) {
            if ($alarmValue == 0) {
                $this->_getLogger()->emergency('Process pool has no alarms and no processes.');
                throw new \LogicException('Invalid process pool state.');
            }else {
                $this->_getLogger()->notice('Process pool only has a set alarm.');
            }
        }
        pcntl_alarm($alarmValue);

        return $this;
    }

    public function getProcess(): ProcessInterface
    {
        return $this->_getProcess();
    }
}