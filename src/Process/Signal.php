<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process\Signal\HandlerInterface;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Process;

class Signal implements SignalInterface
{
    use Defensive\AwareTrait;
    use Process\Signal\Information\Factory\AwareTrait;
    use Process\Pool\Logger\AwareTrait;
    protected $_waitCount       = 0;
    protected $_signalHandlers  = [];
    protected $_bufferedSignals = [];

    public function addSignalHandler(int $signalNumber, HandlerInterface $signalHandler): SignalInterface
    {
        $this->incrementWaitCount();
        pcntl_async_signals(true);
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
        if ($this->_waitCount === 1) {
            $this->_processBufferedSignals();
        }
        --$this->_waitCount;

        return $this;
    }

    protected function _processBufferedSignals(): SignalInterface
    {
        foreach ($this->_bufferedSignals as $position => $information) {
            unset($this->_bufferedSignals[$position]);
            call_user_func([$this->_getSignalHandler($information->getSignalNumber()), 'handleSignal'], $information);
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
            while ($childProcessId = pcntl_wait($status, WNOHANG)) {
                if ($childProcessId == -1) {
                    $errorMessage = var_export(pcntl_strerror(pcntl_get_last_error()), true);
                    $this->_getLogger()->notice("Encountered a process control wait error with message[$errorMessage].");
                    break;
                }else {
                    $this->_getLogger()->info("Handling signal from child process ID[$childProcessId].");
                    $childInformation[InformationInterface::SIGNAL_NUMBER] = SIGCHLD;
                    $childInformation[InformationInterface::PROCESS_ID] = $childProcessId;
                    $childInformation[InformationInterface::EXIT_VALUE] = $status;
                    $information = $this->_getProcessSignalInformationFactory()->create()->hydrate($childInformation);
                    $this->_bufferedSignals[] = $information;
                }
            }
        }else {
            $information = $this->_getProcessSignalInformationFactory()->create()->hydrate($signalInformation);
            $this->_getLogger()->info("Handling signal number[{$information->getSignalNumber()}].");
            $this->_bufferedSignals[] = $information;
        }
        if ($this->_waitCount === 0) {
            $this->_processBufferedSignals();
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