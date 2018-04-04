<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Process\Collection;

abstract class StrategyAbstract implements StrategyInterface
{
    use AwareTrait;
    use Strict\AwareTrait;
    use Logger\AwareTrait;
    use Collection\AwareTrait;

    public function setMaxAlarmTime(int $seconds): StrategyInterface
    {
        $this->_create(self::PROP_MAX_ALARM_TIME, $seconds);

        return $this;
    }

    public function getMaxAlarmTime(): int
    {
        return $this->_read(self::PROP_MAX_ALARM_TIME);
    }

    public function setChildProcessWaitThrottle(int $seconds): StrategyInterface
    {
        $this->_create(self::PROP_CHILD_PROCESS_WAIT_THROTTLE, $seconds);

        return $this;
    }

    public function getChildProcessWaitThrottle(): int
    {
        return $this->_read(self::PROP_CHILD_PROCESS_WAIT_THROTTLE);
    }

    public function setMaxChildProcesses(int $maxChildProcesses): StrategyInterface
    {
        $this->_create(self::PROP_MAX_CHILD_PROCESSES, $maxChildProcesses);

        return $this;
    }

    public function getMaxChildProcesses(): int
    {
        return $this->_read(self::PROP_MAX_CHILD_PROCESSES);
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

    public function setMaximumLoadAverage(float $maximumLoadAverage): StrategyInterface
    {
        $this->_create(self::PROP_MAXIMUM_LOAD_AVERAGE, $maximumLoadAverage);

        return $this;
    }

    public function getMaximumLoadAverage(): float
    {
        return $this->_read(self:: PROP_MAXIMUM_LOAD_AVERAGE);
    }
}