<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\FormatterInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Psr\Log;

interface LoggerInterface extends Log\LoggerInterface
{
    public function setProcess(ProcessInterface $process): LoggerInterface;

    public function setIsEnabled(bool $isEnabled): LoggerInterface;

    public function getLogFormatter() : FormatterInterface;

    public function setLogFormatter(FormatterInterface $log_formatter) : LoggerInterface;

    public function setLevelFilterMask(array $level_filter_mask): LoggerInterface;

    public function setJob(JobInterface $job) : LoggerInterface;
}
