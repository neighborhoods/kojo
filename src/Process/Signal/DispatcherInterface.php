<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal;

interface DispatcherInterface
{
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
    public function handleSignal(int $signalNumber, $signalInformation): void;

    public function ignoreSignal(int $signalNumber): DispatcherInterface;

    public function registerSignalHandler(
        int $signalNumber,
        HandlerInterface $handler,
        bool $isBuffered
    ): DispatcherInterface;

    public function processBufferedSignals(): DispatcherInterface;
}
