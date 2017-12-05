<?php

namespace NHDS\Jobs\Process\Pool;

use Psr\Log;

interface LoggerInterface extends Log\LoggerInterface
{
    public function setProcessPoolProcessId(int $processPoolProcessId): LoggerInterface;

    public function setProcessId(int $processId): LoggerInterface;

    public function setIsEnabled(bool $isEnabled): LoggerInterface;
}