<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\ProcessInterface;
use Psr\Log;

interface LoggerInterface extends Log\LoggerInterface
{
    public function setProcess(ProcessInterface $process): LoggerInterface;

    public function setIsEnabled(bool $isEnabled): LoggerInterface;

    public function setProcessPathPadding(int $processPathPadding): LoggerInterface;

    public function setProcessIdPadding(int $processIdPadding): LoggerInterface;

    public function getLogFormatter() : LogFormatterInterface;

    public function setLogFormatter(LogFormatterInterface $log_formatter) : LoggerInterface;
}
