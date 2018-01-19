<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\Process\CollectionInterface;
use NHDS\Jobs\Process\PoolInterface;
use NHDS\Jobs\ProcessInterface;

interface StrategyInterface
{
    public function setProcessPool(PoolInterface $pool);

    public function setProcessCollection(CollectionInterface $collection);

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

    public function setAlarmProcessTypeCode(string $alarmProcessTypeCode): StrategyInterface;

    public function setFillProcessTypeCode(string $fillProcessTypeCode): StrategyInterface;
}