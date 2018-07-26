<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Logger;

abstract class StrategyAbstract implements StrategyInterface
{
    use AwareTrait;
    use Logger\AwareTrait;

    /** @var int */
    protected $maxAlarmTime;
    /** @var int */
    protected $childProcessWaitThrottle;
    /** @var int */
    protected $maxChildProcesses;
    /** @var string */
    protected $alarmProcessTypeId;
    /** @var string */
    protected $fillProcessTypeId;
    /** @var float */
    protected $maximumLoadAverage;

    public function getMaxAlarmTime(): int
    {
        if ($this->maxAlarmTime === null) {
            throw new \LogicException('Strategy maxAlarmTime has not been set.');
        }

        return $this->maxAlarmTime;
    }

    public function setMaxAlarmTime(int $maxAlarmTime): StrategyInterface
    {
        if ($this->maxAlarmTime !== null) {
            throw new \LogicException('Strategy maxAlarmTime is already set.');
        }
        $this->maxAlarmTime = $maxAlarmTime;

        return $this;
    }

    public function getChildProcessWaitThrottle(): int
    {
        if ($this->childProcessWaitThrottle === null) {
            throw new \LogicException('Strategy childProcessWaitThrottle has not been set.');
        }

        return $this->childProcessWaitThrottle;
    }

    public function setChildProcessWaitThrottle(int $childProcessWaitThrottle): StrategyInterface
    {
        if ($this->childProcessWaitThrottle !== null) {
            throw new \LogicException('Strategy childProcessWaitThrottle is already set.');
        }
        $this->childProcessWaitThrottle = $childProcessWaitThrottle;

        return $this;
    }

    public function getMaxChildProcesses(): int
    {
        if ($this->maxChildProcesses === null) {
            throw new \LogicException('Strategy maxChildProcesses has not been set.');
        }

        return $this->maxChildProcesses;
    }

    public function setMaxChildProcesses(int $maxChildProcesses): StrategyInterface
    {
        if ($this->maxChildProcesses !== null) {
            throw new \LogicException('Strategy maxChildProcesses is already set.');
        }
        $this->maxChildProcesses = $maxChildProcesses;

        return $this;
    }

    public function getAlarmProcessTypeId(): string
    {
        if ($this->alarmProcessTypeId === null) {
            throw new \LogicException('StrategyAbstract alarmProcessTypeId has not been set.');
        }

        return $this->alarmProcessTypeId;
    }

    public function setAlarmProcessTypeId(string $alarmProcessTypeId): StrategyInterface
    {
        if ($this->alarmProcessTypeId !== null) {
            throw new \LogicException('Strategy alarmProcessTypeId is already set.');
        }
        $this->alarmProcessTypeId = $alarmProcessTypeId;

        return $this;
    }

    public function hasFillProcessTypeId(): bool
    {
        return $this->fillProcessTypeId === null ? false : true;
    }

    public function getFillProcessTypeId(): string
    {
        if ($this->fillProcessTypeId === null) {
            throw new \LogicException('Strategy fillProcessTypeId has not been set.');
        }

        return $this->fillProcessTypeId;
    }

    public function setFillProcessTypeId(string $fillProcessTypeId): StrategyInterface
    {
        if ($this->fillProcessTypeId !== null) {
            throw new \LogicException('Strategy fillProcessTypeId is already set.');
        }
        $this->fillProcessTypeId = $fillProcessTypeId;

        return $this;
    }

    public function getMaximumLoadAverage(): float
    {
        if ($this->maximumLoadAverage === null) {
            throw new \LogicException('Strategy maximumLoadAverage has not been set.');
        }

        return $this->maximumLoadAverage;
    }

    public function setMaximumLoadAverage(float $maximumLoadAverage): StrategyInterface
    {
        if ($this->maximumLoadAverage !== null) {
            throw new \LogicException('Strategy maximumLoadAverage is already set.');
        }
        $this->maximumLoadAverage = $maximumLoadAverage;

        return $this;
    }
}