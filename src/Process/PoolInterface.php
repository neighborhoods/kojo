<?php

namespace NHDS\Jobs\Process;

use NHDS\Jobs\ProcessInterface;

interface PoolInterface
{
    public function swim(): PoolInterface;

    public function setAlarm(int $seconds): PoolInterface;

    public function isFull(): bool;

    public function isEmpty(): bool;

    public function addProcess(ProcessInterface $process): PoolInterface;

    public function getProcess(int $processId): ProcessInterface;

    public function freeProcess(int $processId): PoolInterface;

    public function getProcessId(): int;

    public function setProcessId(int $processId): PoolInterface;

    public function resetPool(): PoolInterface;

    public function initialize(): PoolInterface;

    public function hasAlarm();
}