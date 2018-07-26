<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Logger;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;
use Neighborhoods\Kojo\ProcessInterface;

abstract class PoolAbstract implements PoolInterface
{
    use Logger\AwareTrait;
    use Process\Pool\Strategy\AwareTrait;
    use Process\AwareTrait;
    use Process\Signal\AwareTrait;

    abstract protected function childExitSignal(InformationInterface $information): PoolInterface;

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
        if ($seconds === 0) {
            $this->getLogger()->info("Disabling any existing alarm.");
        }else {
            $this->getLogger()->info("Setting alarm for $seconds seconds.");
        }
        pcntl_alarm($seconds);

        return $this;
    }

    public function isEmpty(): bool
    {
        return ($this->getCountOfChildProcesses() === 0);
    }

    public function isFull(): bool
    {
        return ($this->getCountOfChildProcesses() >= $this->getProcessPoolStrategy()->getMaxChildProcesses());
    }

    public function canEnvironmentSustainAdditionProcesses(): bool
    {
        return ((float)current(sys_getloadavg()) <= $this->getProcessPoolStrategy()->getMaximumLoadAverage());
    }

    protected function initialize(): PoolInterface
    {
        $this->getProcessPoolStrategy()->initializePool();

        return $this;
    }

    protected function alarmSignal(InformationInterface $information): PoolInterface
    {
        $this->getProcessPoolStrategy()->receivedAlarm();

        return $this;
    }

    protected function validateAlarm(): PoolInterface
    {
        $alarmValue = pcntl_alarm(0);
        if ($this->isEmpty()) {
            if ($alarmValue == 0) {
                $this->getLogger()->emergency('Process pool has no alarms and no processes.');
                throw new \LogicException('Invalid process pool state.');
            }else {
                $this->getLogger()->notice('Process pool only has a set alarm.');
            }
        }
        pcntl_alarm($alarmValue);

        return $this;
    }

    public function getProcess(): ProcessInterface
    {
        return $this->getProcess();
    }
}