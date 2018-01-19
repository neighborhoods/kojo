<?php
declare(strict_types=1);

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

    public function addChildProcess(ProcessInterface $childProcess): PoolInterface;

    public function getChildProcess(int $childProcessId): ProcessInterface;

    public function freeChildProcess(int $childProcessId): PoolInterface;

    public function emptyChildProcesses(): PoolInterface;

    public function hasAlarm(): bool;

    public function terminateChildProcesses(): PoolInterface;

    public function getCountOfChildProcesses(): int;

    public function setProcess(ProcessInterface $process);

    public function getProcessPath(): string;
}