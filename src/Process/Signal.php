<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process\Signal\HandlerInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Process;

class Signal implements SignalInterface
{
    use Defensive\AwareTrait;
    use Process\Signal\Information\AwareTrait;
    protected $_waitCount       = 0;
    protected $_signalHandlers  = [];
    protected $_bufferedSignals = [];

    public function addSignalHandler(int $signalNumber, HandlerInterface $signalHandler): SignalInterface
    {
        $this->incrementWaitCount();
        $this->_signalHandlers[$signalNumber] = $signalHandler;
        pcntl_signal($signalNumber, [$this, 'handleSignal']);
        $this->decrementWaitCount();

        return $this;
    }

    public function incrementWaitCount(): SignalInterface
    {
        ++$this->_waitCount;

        return $this;
    }

    public function decrementWaitCount(): SignalInterface
    {
        while ($this->_waitCount >= 1) {
            $this->_processBufferedSignals();
            --$this->_waitCount;
        }

        return $this;
    }

    protected function _processBufferedSignals(): SignalInterface
    {
        foreach ($this->_bufferedSignals as $position => $information) {
            call_user_func([$this->_getSignalHandler($information->getSignalNumber()), 'handleSignal'], $information);
            unset($this->_bufferedSignals[$position]);
        }

        return $this;
    }

    protected function _getSignalHandler(int $signalNumber): HandlerInterface
    {
        if (!isset($this->_signalHandlers[$signalNumber])) {
            throw new \LogicException("Signal handler for signal number[$signalNumber] is not set.");
        }

        return $this->_signalHandlers[$signalNumber];
    }

    /**
     * Signals are "blocked" by PHP while the IRQ handling logic is executed
     * from the context of being called by the VM as a signal handler.
     */
    public function handleSignal(int $signalNumber, $signalInformation): void
    {
        if ($signalNumber === SIGCHLD) {
            $childProcessId = pcntl_wait($status, WNOHANG);
            if ($childProcessId == -1) {
                $error = var_export(pcntl_strerror(pcntl_get_last_error()), true);
            }else {
                $this->_bufferedSignals[] = $this->_getProcessSignalInformationClone()->hydrate($signalInformation);
            }
        }else {
            $this->_bufferedSignals[] = $this->_getProcessSignalInformationClone()->hydrate($signalInformation);
        }
        if ($this->_waitCount === 0) {
            $this->_processBufferedSignals();
        }elseif ($this->_waitCount < 2) {
            ++$this->_waitCount;
        }

        return;
    }

    public function waitForSignal(): SignalInterface
    {
        $this->block();
        $signalNumber = pcntl_sigwaitinfo(array_keys($this->_signalHandlers), $signalInformation);
        $this->handleSignal($signalNumber, $signalInformation);
        $this->unBlock();

        return $this;
    }

    public function block(): SignalInterface
    {
        pcntl_sigprocmask(SIG_BLOCK, array_keys($this->_signalHandlers));

        return $this;
    }

    public function unBlock(): SignalInterface
    {
        pcntl_sigprocmask(SIG_UNBLOCK, array_keys($this->_signalHandlers));

        return $this;
    }
}