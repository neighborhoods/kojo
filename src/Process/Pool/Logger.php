<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Pylon\Data\Property\Defensive;
use Psr\Log;

class Logger extends Log\AbstractLogger implements LoggerInterface
{
    use Logger\Message\Builder\Factory\AwareTrait;
    use Defensive\AwareTrait;

    public const PROP_IS_ENABLED = 'is_enabled';

    protected $log_formatter;
    protected $level_filter_mask;

    public function log($level, $message, array $context = [])
    {
        if ($this->_isEnabled() === true && $this->getLevelFilterMask()[$level] === false) {
            $logMessageBuilder = $this->getProcessPoolLoggerMessageBuilderFactory()->create();
            $logMessageBuilder->setLevel($level);
            $logMessageBuilder->setMessage($message);
            $logMessageBuilder->setContext($context);

            $logMessage = $logMessageBuilder->build();
            fwrite(STDOUT, $this->getLogFormatter()->getFormattedMessage($logMessage) . PHP_EOL);

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

    public function getLogFormatter(): Logger\FormatterInterface
    {
        if ($this->log_formatter === null) {
            throw new \LogicException('Logger log_formatter has not been set.');
        }

        return $this->log_formatter;
    }

    public function setLogFormatter(Logger\FormatterInterface $log_formatter): LoggerInterface
    {
        if ($this->log_formatter !== null) {
            throw new \LogicException('Logger log_formatter already set.');
        }

        $this->log_formatter = $log_formatter;

        return $this;
    }
}
