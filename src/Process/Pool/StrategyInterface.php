<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\Process\CollectionInterface;
use NHDS\Jobs\Process\PoolInterface;
use NHDS\Jobs\ProcessInterface;

interface StrategyInterface
{
    public function setProcessPool(PoolInterface $pool);

    public function setProcessCollection(CollectionInterface $collection);

    public function initializePool(): StrategyInterface;

    public function processExited(ProcessInterface $process): StrategyInterface;

    public function receivedAlarm(): StrategyInterface;

    public function setMaxAlarmTime(int $seconds): StrategyInterface;

    public function setProcessWaitThrottle(int $seconds): StrategyInterface;

    public function setMaxProcesses(int $maxProcesses): StrategyInterface;

    public function getMaxAlarmTime(): int;

    public function getProcessWaitThrottle(): int;

    public function getMaxProcesses(): int;

    public function currentPendingChildExitsComplete(): StrategyInterface;

    public function setAlarmProcessTypeCode(string $alarmProcessTypeCode): StrategyInterface;

    public function setFillProcessTypeCode(string $fillProcessTypeCode): StrategyInterface;
}