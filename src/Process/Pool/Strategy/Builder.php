<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy;

use Neighborhoods\Kojo\Process\Pool\StrategyInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;

    /** @var int */
    protected $maxChildProcesses;
    /** @var int */
    protected $childProcessWaitThrottle;
    /** @var int */
    protected $maxAlarmTime;

    public function build(): StrategyInterface
    {
        $strategy = $this->getProcessPoolStrategyFactory()->create();
        $strategy->setMaxChildProcesses($this->getMaxChildProcesses());
        $strategy->setChildProcessWaitThrottle($this->getChildProcessWaitThrottle());
        $strategy->setMaxAlarmTime($this->getMaxAlarmTime());

        return $strategy;
    }

    public function getMaxChildProcesses(): int
    {
        if ($this->maxChildProcesses === null) {
            throw new \LogicException('Builder maxChildProcesses has not been set.');
        }

        return $this->maxChildProcesses;
    }

    public function setMaxChildProcesses(int $maxChildProcesses): BuilderInterface
    {
        if ($this->maxChildProcesses !== null) {
            throw new \LogicException('Builder maxChildProcesses is already set.');
        }
        $this->maxChildProcesses = $maxChildProcesses;

        return $this;
    }

    public function getChildProcessWaitThrottle(): int
    {
        if ($this->childProcessWaitThrottle === null) {
            throw new \LogicException('Builder childProcessWaitThrottle has not been set.');
        }

        return $this->childProcessWaitThrottle;
    }

    public function setChildProcessWaitThrottle(int $childProcessWaitThrottle): BuilderInterface
    {
        if ($this->childProcessWaitThrottle !== null) {
            throw new \LogicException('Builder childProcessWaitThrottle is already set.');
        }
        $this->childProcessWaitThrottle = $childProcessWaitThrottle;

        return $this;
    }

    public function getMaxAlarmTime(): int
    {
        if ($this->maxAlarmTime === null) {
            throw new \LogicException('Builder maxAlarmTime has not been set.');
        }

        return $this->maxAlarmTime;
    }

    public function setMaxAlarmTime(int $maxAlarmTime): BuilderInterface
    {
        if ($this->maxAlarmTime !== null) {
            throw new \LogicException('Builder maxAlarmTime is already set.');
        }
        $this->maxAlarmTime = $maxAlarmTime;

        return $this;
    }
}