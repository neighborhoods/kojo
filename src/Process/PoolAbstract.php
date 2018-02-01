<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\Process;
use NHDS\Jobs\ProcessInterface;
use NHDS\Toolkit\Data\Property\Strict;

abstract class PoolAbstract implements PoolInterface
{
    use Strict\AwareTrait;
    use Process\Pool\Logger\AwareTrait;
    use Process\Pool\Strategy\AwareTrait;
    use Process\AwareTrait;

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
        $this->_getLogger()->debug('Setting alarm for ' . $seconds . ' seconds.');
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
        register_shutdown_function([$this, 'terminateChildProcesses']);
        $this->_getProcessPoolStrategy()->initializePool();

        return $this;
    }

    protected function _alarmSignal(): PoolInterface
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