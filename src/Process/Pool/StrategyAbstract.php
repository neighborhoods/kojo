<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Process\Collection;

abstract class StrategyAbstract implements StrategyInterface
{
    use AwareTrait;
    use Strict\AwareTrait;
    use Logger\AwareTrait;
    use Collection\AwareTrait;
    const PROP_MAX_ALARM_TIME          = 'max_alarm_time';
    const PROP_PROCESS_WAIT_THROTTLE   = 'process_wait_throttle';
    const PROP_MAX_PROCESSES           = 'max_processes';
    const PROP_ALARM_PROCESS_TYPE_CODE = 'alarm_process_type_code';
    const PROP_FILL_PROCESS_TYPE_CODE  = 'fill_process_type_code';

    public function setMaxAlarmTime(int $seconds): StrategyInterface
    {
        $this->_create(self::PROP_MAX_ALARM_TIME, $seconds);

        return $this;
    }

    public function getMaxAlarmTime(): int
    {
        return $this->_read(self::PROP_MAX_ALARM_TIME);
    }

    public function setProcessWaitThrottle(int $seconds): StrategyInterface
    {
        $this->_create(self::PROP_PROCESS_WAIT_THROTTLE, $seconds);

        return $this;
    }

    public function getProcessWaitThrottle(): int
    {
        return $this->_read(self::PROP_PROCESS_WAIT_THROTTLE);
    }

    public function setMaxProcesses(int $maxProcesses): StrategyInterface
    {
        $this->_create(self::PROP_MAX_PROCESSES, $maxProcesses);

        return $this;
    }

    public function getMaxProcesses(): int
    {
        return $this->_read(self::PROP_MAX_PROCESSES);
    }

    public function setAlarmProcessTypeCode(string $alarmProcessTypeCode): StrategyInterface
    {
        $this->_create(self::PROP_ALARM_PROCESS_TYPE_CODE, $alarmProcessTypeCode);

        return $this;
    }

    protected function _getAlarmProcessTypeCode(): string
    {
        return $this->_read(self::PROP_ALARM_PROCESS_TYPE_CODE);
    }

    public function setFillProcessTypeCode(string $fillProcessTypeCode): StrategyInterface
    {
        $this->_create(self::PROP_FILL_PROCESS_TYPE_CODE, $fillProcessTypeCode);

        return $this;
    }

    protected function _hasFillProcessTypeCode(): bool
    {
        return $this->_exists(self::PROP_FILL_PROCESS_TYPE_CODE);
    }

    protected function _getFillProcessTypeCode(): string
    {
        return $this->_read(self::PROP_FILL_PROCESS_TYPE_CODE);
    }
}