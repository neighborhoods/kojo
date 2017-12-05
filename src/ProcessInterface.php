<?php

namespace NHDS\Jobs;

use NHDS\Jobs\Process\Pool\LoggerInterface;

interface ProcessInterface
{
    public function fork(int $parentPid): ProcessInterface;

    public function getProcessId(): int;

    public function setLogger(LoggerInterface $logger);

    public function setThrottle(int $seconds = 0): ProcessInterface;

    public function setExitCode(int $exitCode): ProcessInterface;

    public function getExitCode(): int;

    public function getParentProcessId(): int;
}