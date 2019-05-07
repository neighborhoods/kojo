<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process\Pool\StrategyInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Process\Signal\HandlerInterface;

interface PoolInterface extends HandlerInterface
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

    public function getProcess(): ProcessInterface;
}
