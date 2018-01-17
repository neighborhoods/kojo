<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Process;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Process\Pool\AwareTrait;
    use Process\Pool\Strategy\AwareTrait;
    use Process\Collection\AwareTrait;
    const PROP_MAX_PROCESSES         = 'max_processes';
    const PROP_PROCESS_WAIT_THROTTLE = 'process_wait_throttle';
    const PROP_MAX_ALARM_TIME        = 'max_alarm_time';

    public function create()
    {
        $processPool = $this->_getProcessPoolClone();
        $processPoolStrategy = $this->_getProcessPoolStrategyClone();
        $processPoolStrategy->setProcessCollection($this->_getProcessCollection());
        $processPoolStrategy->setMaxProcesses($this->_getMaxProcesses());
        $processPoolStrategy->setProcessWaitThrottle($this->_getProcessWaitThrottle());
        $processPoolStrategy->setMaxAlarmTime($this->_getMaxAlarmTime());
        $processPool->setProcessPoolStrategy($processPoolStrategy);
        $processPoolStrategy->setProcessPool($processPool);

        return $processPool;
    }

    public function setMaxProcesses(int $maxProcesses): FactoryInterface
    {
        $this->_create(self::PROP_MAX_PROCESSES, $maxProcesses);

        return $this;
    }

    protected function _getMaxProcesses(): int
    {
        return $this->_read(self::PROP_MAX_PROCESSES);
    }

    public function setProcessWaitThrottle(int $seconds): FactoryInterface
    {
        $this->_create(self::PROP_PROCESS_WAIT_THROTTLE, $seconds);

        return $this;
    }

    protected function _getProcessWaitThrottle(): int
    {
        return $this->_read(self::PROP_PROCESS_WAIT_THROTTLE);
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