<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Process\Collection;

abstract class StrategyAbstract implements StrategyInterface
{
    use Strict\AwareTrait;
    use AwareTrait;
    use Logger\AwareTrait;
    use Collection\AwareTrait;
    protected $_maxAlarmTime;
    protected $_processWaitThrottle;
    protected $_maxProcesses;

    public function getMaxAlarmTime(): int
    {
        if ($this->_maxAlarmTime === null) {
            throw new \LogicException('Max alarm time is not set.');
        }

        return $this->_maxAlarmTime;
    }

    public function getProcessWaitThrottle(): int
    {
        if ($this->_processWaitThrottle === null) {
            throw new \LogicException('Process wait throttle is not set.');
        }

        return $this->_processWaitThrottle;
    }

    public function getMaxProcesses(): int
    {
        if ($this->_maxProcesses === null) {
            throw new \LogicException('Max processes is not set.');
        }

        return $this->_maxProcesses;
    }

    public function setMaxAlarmTime(int $seconds): StrategyInterface
    {
        if ($this->_maxAlarmTime === null) {
            $this->_maxAlarmTime = $seconds;
        }else {
            throw new \LogicException('Max alarm time is already set.');
        }

        return $this;
    }

    public function setProcessWaitThrottle(int $seconds): StrategyInterface
    {
        if ($this->_processWaitThrottle === null) {
            $this->_processWaitThrottle = $seconds;
        }else {
            throw new \LogicException('Process wait throttle is already set.');
        }

        return $this;
    }

    public function setMaxProcesses(int $maxProcesses): StrategyInterface
    {
        if ($this->_maxProcesses === null) {
            $this->_maxProcesses = $maxProcesses;
        }else {
            throw new \LogicException('Max processes is not set.');
        }

        return $this;
    }
}