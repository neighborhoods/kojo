<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process\Signal\HandlerInterface;

interface SignalInterface
{
    public function incrementWaitCount(): SignalInterface;

    public function decrementWaitCount(): SignalInterface;

    /**
     * Signals are blocked by PHP while the IRQ handling logic is executed.
     */
    public function handleSignal(int $signalNumber, $signalInformation): void;

    public function addSignalHandler(int $signalNumber, HandlerInterface $signalHandler): SignalInterface;

    public function block(): SignalInterface;
}