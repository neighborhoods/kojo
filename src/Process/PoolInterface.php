<?php

namespace NHDS\Jobs\Process;

use NHDS\Jobs\Process\Pool\StrategyInterface;
use NHDS\Jobs\ProcessInterface;

interface PoolInterface
{
    public function start(): PoolInterface;

    public function setProcessPoolStrategy(StrategyInterface $strategy);

    public function setAlarm(int $seconds): PoolInterface;

    public function isFull(): bool;

    public function isEmpty(): bool;

    public function addProcess(ProcessInterface $process): PoolInterface;

    public function getProcess(int $processId): ProcessInterface;

    public function freeProcess(int $processId): PoolInterface;

    public function emptyProcesses(): PoolInterface;

    public function hasAlarm();

    public function terminateChildProcesses();
}