<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\ProcessInterface;

interface StrategyInterface
{
    public function initializePool(): StrategyInterface;

    public function childProcessExited(ProcessInterface $process): StrategyInterface;

    public function receivedAlarm(): StrategyInterface;

    public function setMaxAlarmTime(int $seconds): StrategyInterface;

    public function setChildProcessWaitThrottle(int $seconds): StrategyInterface;

    public function setMaxChildProcesses(int $maxChildProcesses): StrategyInterface;

    public function getMaxAlarmTime(): int;

    public function getChildProcessWaitThrottle(): int;

    public function getMaxChildProcesses(): int;

    public function currentPendingChildExitsCompleted(): StrategyInterface;

    public function setAlarmProcessTypeId(string $alarmProcessTypeCode): StrategyInterface;

    public function setFillProcessTypeId(string $fillProcessTypeCode): StrategyInterface;

    public function setMaximumLoadAverage(float $maximumLoadAverage): StrategyInterface;

    public function getMaximumLoadAverage(): float;
}