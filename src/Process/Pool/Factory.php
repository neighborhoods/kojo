<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Service\FactoryAbstract;
use Neighborhoods\Kojo\Process;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Process\Pool\AwareTrait;
    use Process\Pool\Strategy\AwareTrait;
    use Process\Collection\AwareTrait;
    const PROP_MAX_CHILD_PROCESSES         = 'max_child_processes';
    const PROP_CHILD_PROCESS_WAIT_THROTTLE = 'child_process_wait_throttle';
    const PROP_MAX_ALARM_TIME              = 'max_alarm_time';

    public function create()
    {
        $processPool = $this->_getProcessPoolClone();
        $processPoolStrategy = $this->_getProcessPoolStrategyClone();
        $processPoolStrategy->setProcessCollection($this->_getProcessCollection());
        $processPoolStrategy->setMaxChildProcesses($this->_getMaxChildProcesses());
        $processPoolStrategy->setChildProcessWaitThrottle($this->_getChildProcessWaitThrottle());
        $processPoolStrategy->setMaxAlarmTime($this->_getMaxAlarmTime());
        $processPool->setProcessPoolStrategy($processPoolStrategy);
        $processPoolStrategy->setProcessPool($processPool);

        return $processPool;
    }

    public function setMaxChildProcesses(int $maxChildProcesses): FactoryInterface
    {
        $this->_create(self::PROP_MAX_CHILD_PROCESSES, $maxChildProcesses);

        return $this;
    }

    protected function _getMaxChildProcesses(): int
    {
        return $this->_read(self::PROP_MAX_CHILD_PROCESSES);
    }

    public function setChildProcessWaitThrottle(int $seconds): FactoryInterface
    {
        $this->_create(self::PROP_CHILD_PROCESS_WAIT_THROTTLE, $seconds);

        return $this;
    }

    protected function _getChildProcessWaitThrottle(): int
    {
        return $this->_read(self::PROP_CHILD_PROCESS_WAIT_THROTTLE);
    }

    public function setMaxAlarmTime(int $seconds): FactoryInterface
    {
        $this->_create(self::PROP_MAX_ALARM_TIME, $seconds);

        return $this;
    }

    protected function _getMaxAlarmTime(): int
    {
        return $this->_read(self::PROP_MAX_ALARM_TIME);
    }
}