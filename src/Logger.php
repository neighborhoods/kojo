<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Logger\FormatterInterface;
use Psr\Log;

class Logger extends Log\AbstractLogger implements LoggerInterface
{
    use Time\AwareTrait;
    use Logger\Message\Factory\AwareTrait;
    public const PROP_IS_ENABLED = 'is_enabled';
    protected const LOG_DATE_TIME_FORMAT = 'D, d M y H:i:s.u T';

    protected $log_formatter;
    protected $level_filter_mask;
    protected $process;
    protected $isEnabled;

    public function setProcess(ProcessInterface $process): LoggerInterface
    {
        $this->process = $process;

        return $this;
    }

    protected function getProcess(): ProcessInterface
    {
        if ($this->process === null) {
            throw new \LogicException('Process is not set.');
        }

        return $this->process;
    }

    protected function hasProcess(): bool
    {
        return $this->process === null ? false : true;
    }

    public function log($level, $message, array $context = [])
    {
        if ($this->isEnabled() === true) {
            if ($this->getLevelFilterMask()[$level] === false) {
                if ($this->hasProcess()) {
                    $processId = (string)$this->getProcess()->getProcessId();
                } else {
                    $processId = '?';
                }

                $referenceTime = $this->getTime()->getNow();
                $logMessage = $this->getProcessPoolLoggerMessageFactory()->create();
                $logMessage->setTime($referenceTime->format(self::LOG_DATE_TIME_FORMAT));
                $logMessage->setLevel($level);
                $logMessage->setProcessId($processId);
                $logMessage->setProcessPath($this->getProcess()->getPath());
                $logMessage->setMessage($message);
                fwrite(STDOUT, $this->getLogFormatter()->getFormattedMessage($logMessage) . "\n");
            }
        }

        return;
    }

    public function setLevelFilterMask(array $level_filter_mask): LoggerInterface
    {
        if ($this->level_filter_mask === null) {
            $this->level_filter_mask = $level_filter_mask;
        } else {
            throw new \LogicException('Logger level_filter_mask is already set.');
        }

        return $this;
    }

    protected function getLevelFilterMask(): array
    {
        if ($this->level_filter_mask === null) {
            $this->level_filter_mask = [];
        }

        return $this->level_filter_mask;
    }

    protected function isEnabled(): bool
    {
        if ($this->isEnabled === null) {
            throw new \LogicException('Is enabled is not set.');
        }

        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): LoggerInterface
    {
        if ($this->isEnabled === null) {
            $this->isEnabled = $isEnabled;
        } else {
            throw new \LogicException('Is enabled is already set.');
        }

        return $this;
    }

    public function getLogFormatter(): FormatterInterface
    {
        if ($this->log_formatter === null) {
            throw new \LogicException('Logger log_formatter has not been set.');
        }

        return $this->log_formatter;
    }

    public function setLogFormatter(FormatterInterface $log_formatter): LoggerInterface
    {
        if ($this->log_formatter !== null) {
            throw new \LogicException('Logger log_formatter already set.');
        }

        $this->log_formatter = $log_formatter;

        return $this;
    }
}
