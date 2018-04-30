<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1;

use Neighborhoods\Kojo\Process;

class Logger implements LoggerInterface
{
    use Process\Pool\Logger\AwareTrait;

    /** System is unusable. */
    public function emergency($message, array $context = array())
    {
        $this->_getLogger()->emergency($message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     */
    public function alert($message, array $context = array())
    {
        $this->_getLogger()->alert($message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     */
    public function critical($message, array $context = array())
    {
        $this->_getLogger()->critical($message, $context);
    }

    /** Runtime errors that do not require immediate action but should typically be logged and monitored. */
    public function error($message, array $context = array())
    {
        $this->_getLogger()->error($message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     */
    public function warning($message, array $context = array())
    {
        $this->_getLogger()->warning($message, $context);
    }

    /** Normal but significant events. */
    public function notice($message, array $context = array())
    {
        $this->_getLogger()->notice($message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     */
    public function info($message, array $context = array())
    {
        $this->_getLogger()->info($message, $context);
    }

    /** Detailed debug information. */
    public function debug($message, array $context = array())
    {
        $this->_getLogger()->debug($message, $context);
    }

    /** Logs with an arbitrary level. */
    public function log($level, $message, array $context = array())
    {
        $this->_getLogger()->log($level, $message, $context);
    }
}