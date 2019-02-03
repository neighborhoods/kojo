<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process\Signal\HandlerInterface;

interface SignalInterface
{
    public function handleSignal(int $signalNumber, $signalInformation): void;

    public function addSignalHandler(int $signalNumber, HandlerInterface $signalHandler): SignalInterface;

    public function processBufferedSignals(): SignalInterface;
}
