<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\ProcessInterface;
use Psr\Log;

interface LoggerInterface extends Log\LoggerInterface
{
    public function setProcessPoolProcessId(int $processPoolProcessId): LoggerInterface;

    public function setProcess(ProcessInterface $process): LoggerInterface;

    public function setIsEnabled(bool $isEnabled): LoggerInterface;
}