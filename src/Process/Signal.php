<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

class Signal implements SignalInterface
{
    protected $_blockedSignalNumbers = [];
    protected $_isBlocked            = false;

    public function &_getBlockingSignalNumbers(): array
    {
        if (empty($this->_blockedSignalNumbers)) {
            pcntl_async_signals(true);
            $this->_blockedSignalNumbers = self::DEFAULT_BLOCKED_SIGNAL_NUMBERS;
        }

        return $this->_blockedSignalNumbers;
    }

    public function addBlockedSignalNumber(int $signalNumber): SignalInterface
    {
        $this->_blockedSignalNumbers[$signalNumber] = $signalNumber;

        return $this;
    }

    public function addSignalHandler(int $signalNumber, callable $signalHandler): SignalInterface
    {
        pcntl_signal($signalNumber, $signalHandler);

        return $this;
    }

    public function block(): SignalInterface
    {
        pcntl_sigprocmask(SIG_SETMASK, array_keys($this->_getBlockingSignalNumbers()));
        $this->_isBlocked = true;

        return $this;
    }

    public function unBlock(): SignalInterface
    {
        $this->_isBlocked = false;
        pcntl_sigprocmask(SIG_SETMASK, self::DEFAULT_BLOCKED_SIGNAL_NUMBERS);

        return $this;
    }
}