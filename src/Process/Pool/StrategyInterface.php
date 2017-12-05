<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\ProcessInterface;

interface StrategyInterface
{
    public function initializePool(): StrategyInterface;

    public function handleProcessExit(ProcessInterface $process): StrategyInterface;

    public function handleAlarm(): StrategyInterface;

    public function setMaxAlarmTime(int $seconds): StrategyInterface;

    public function setProcessWaitThrottle(int $seconds): StrategyInterface;

    public function setMaxProcesses(int $maxProcesses): StrategyInterface;

    public function getMaxAlarmTime(): int;

    public function getProcessWaitThrottle(): int;

    public function getMaxProcesses(): int;
}