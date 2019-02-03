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
    protected $signalHandlers = [];
    protected $bufferedSignals = [];

    public function addSignalHandler(int $signalNumber, HandlerInterface $signalHandler): SignalInterface
    {
        pcntl_async_signals(true);
        $this->signalHandlers[$signalNumber] = $signalHandler;
        pcntl_signal($signalNumber, [$this, 'handleSignal']);

        return $this;
    }

    public function processBufferedSignals(): SignalInterface
    {
        foreach ($this->bufferedSignals as $position => $information) {
            unset($this->bufferedSignals[$position]);
            $this->processSignalInformation($information);
        }

        return $this;
    }

    protected function processSignalInformation(InformationInterface $information): SignalInterface
    {
        call_user_func([$this->getSignalHandler($information->getSignalNumber()), 'handleSignal'], $information);

        return $this;
    }

    protected function getSignalHandler(int $signalNumber): HandlerInterface
    {
        if (!isset($this->signalHandlers[$signalNumber])) {
            throw new \LogicException("Signal handler for signal number[$signalNumber] is not set.");
        }

        return $this->signalHandlers[$signalNumber];
    }

    /**
     * The VM uses sigprocmask and a global data structure to prevent reentrancy. The latter is not exposed to
     * user space so all user space signal processing will be halted and until this method returns.
     * This has a serious consequence when using fork, since the expectation is that the execution branch will not
     * return. Since the kernel copies the exact memory image from the parent process to the new child process,
     * the blocking VM data structure persists in the child process. Thereby blocking any future user space signal
     * handling in the new process.
     *
     * Any non-terminating signals that result in non-deterministic or non-returning execution branches have to be
     * buffered and processed using processBufferedSignals otherwise future signals will not be handled (since they
     * will be blocked by the VM).
     *
     * Terminating signals however must be handled immediately.
     *
     * In the future, Kōjō signal handlers MUST specify whether or not they should be processed immediately, that is,
     * with the knowledge that all other signals will be blocked until their execution branch returns, or if they
     * should be buffered and deferred.
     *
     * Signals that specify that they should be handled immediately MUST return deterministically, or result
     * in program termination.
     */
    public function handleSignal(int $signalNumber, $signalInformation): void
    {
        $this->_getLogger()->debug(sprintf('Received signal[%s].', $signalNumber));
        if ($signalNumber === SIGCHLD) {
            while ($childProcessId = pcntl_wait($status, WNOHANG)) {
                $lastPCNTLError = pcntl_get_last_error();
                if ($childProcessId != -1) {
                    $this->_getLogger()->debug("Child with process ID[$childProcessId] exited with status[$status].");
                    $childInformation[InformationInterface::SIGNAL_NUMBER] = SIGCHLD;
                    $childInformation[InformationInterface::PROCESS_ID] = $childProcessId;
                    $childInformation[InformationInterface::EXIT_VALUE] = $status;
                    $information = $this->_getProcessSignalInformationFactory()->create()->hydrate($childInformation);
                    $this->bufferedSignals[] = $information;
                } elseif ($lastPCNTLError === PCNTL_ECHILD) {
                    break;
                } else {
                    $message = sprintf('Encountered pcntl error[%s] while processing SIGCHLD.', $lastPCNTLError);
                    $this->_getLogger()->critical($message);
                    throw new \RuntimeException($message);
                }
            }
        } else {
            $information = $this->_getProcessSignalInformationFactory()->create()->hydrate($signalInformation);
            if ($information->getSignalNumber() === SIGTERM) {
                // Future Kōjō signal handlers MUST specify immediate or deferred processing.
                // For now, SITGTERM is safe.
                $this->processSignalInformation($information);
            } else {
                $this->bufferedSignals[] = $information;
            }
        }

        return;
    }
}
