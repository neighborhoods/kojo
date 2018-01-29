<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\ProcessInterface;
use Psr\Log;

interface LoggerInterface extends Log\LoggerInterface
{
    public function setProcess(ProcessInterface $process): LoggerInterface;

    public function setIsEnabled(bool $isEnabled): LoggerInterface;

    public function setProcessPathPadding(int $processPathPadding): LoggerInterface;

    public function setProcessIdPadding(int $processIdPadding): LoggerInterface;
}