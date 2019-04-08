<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Monolog\Formatter\NormalizerFormatter;
use Neighborhoods\Kojo\Process\Pool\Logger\FormatterInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Pylon\Time;
use Psr\Log;

class Logger extends Log\AbstractLogger implements LoggerInterface
{
    use Time\AwareTrait;
    use Logger\Message\Factory\AwareTrait;
    use Defensive\AwareTrait;

    public const PROP_IS_ENABLED = 'is_enabled';
    public const CONTEXT_KEY_EXCEPTION = 'exception';
    public const CONTEXT_KEY_EXCEPTION_STRING = 'exception_string';

    protected const LOG_DATE_TIME_FORMAT = 'D, d M y H:i:s.u T';

    protected $log_formatter;
    protected $level_filter_mask;

    public function setProcess(ProcessInterface $process): LoggerInterface
    {
        $this->_createOrUpdate(ProcessInterface::class, $process);

        return $this;
    }

    protected function _getProcess(): ProcessInterface
    {
        return $this->_read(ProcessInterface::class);
    }

    public function log($level, $message, array $context = [])
    {
        if ($this->_isEnabled() === true) {
            if ($this->getLevelFilterMask()[$level] === false) {
                if ($this->_exists(ProcessInterface::class)) {
                    $processId = (string)$this->_getProcess()->getProcessId();
                } else {
                    $processId = '?';
                }

                $referenceTime = $this->_getTime()->getNow();
                $logMessage = $this->getProcessPoolLoggerMessageFactory()->create();
                $logMessage->setTime($referenceTime->format(self::LOG_DATE_TIME_FORMAT));
                $logMessage->setLevel($level);
                $logMessage->setProcessId($processId);
                $logMessage->setProcessPath($this->_getProcess()->getPath());
                $logMessage->setMessage($message);

                if (array_key_exists(self::CONTEXT_KEY_EXCEPTION, $context) && $context[self::CONTEXT_KEY_EXCEPTION]
                instanceof \Throwable){
                    $context[self::CONTEXT_KEY_EXCEPTION_STRING] = (string)$context[self::CONTEXT_KEY_EXCEPTION];
                    $normalizedException = (new NormalizerFormatter())->format([$context[self::CONTEXT_KEY_EXCEPTION]]);
                    unset($context[self::CONTEXT_KEY_EXCEPTION]);
                    $context[self::CONTEXT_KEY_EXCEPTION] = $normalizedException[0];
                }

                if (json_encode($context) === false) {
                    $logMessage->setContext([]);
                } else {
                    $logMessage->setContext($context);
                }

                $logMessage->setContextJsonLastError(json_last_error());
                fwrite(STDOUT, $this->getLogFormatter()->getFormattedMessage($logMessage) . PHP_EOL);
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

    protected function _isEnabled(): bool
    {
        return $this->_read(self::PROP_IS_ENABLED);
    }

    public function setIsEnabled(bool $isEnabled): LoggerInterface
    {
        $this->_create(self::PROP_IS_ENABLED, $isEnabled);

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
