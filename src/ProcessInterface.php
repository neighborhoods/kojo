<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Process\Pool\LoggerInterface;
use NHDS\Jobs\Process\PoolInterface;

interface ProcessInterface
{
    public function start(): ProcessInterface;

    public function getProcessId(): int;

    public function setLogger(LoggerInterface $logger);

    public function setThrottle(int $seconds = 0): ProcessInterface;

    public function setExitCode(int $exitCode): ProcessInterface;

    public function getExitCode(): int;

    public function getParentProcessId(): int;

    public function getTypeCode(): string;

    public function setTypeCode(string $typeCode): ProcessInterface;

    public function setProcessPool(PoolInterface $pool);
}