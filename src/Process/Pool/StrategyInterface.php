<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\Process\CollectionInterface;
use NHDS\Jobs\Process\PoolInterface;
use NHDS\Jobs\ProcessInterface;

interface StrategyInterface
{
    const PROP_ALARM_PROCESS_TYPE_CODE     = 'alarm_process_type_code';
    const PROP_MAX_ALARM_TIME              = 'max_alarm_time';
    const PROP_FILL_PROCESS_TYPE_CODE      = 'fill_process_type_code';
    const PROP_MAX_CHILD_PROCESSES         = 'max_child_processes';
    const PROP_CHILD_PROCESS_WAIT_THROTTLE = 'child_process_wait_throttle';
    const PROP_MAXIMUM_LOAD_AVERAGE        = 'maximum_load_average';

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

    public function setMaximumLoadAverage(float $maximumLoadAverage): StrategyInterface;

    public function getMaximumLoadAverage(): float;
}