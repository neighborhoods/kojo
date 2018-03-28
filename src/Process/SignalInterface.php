<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

interface SignalInterface
{
    public const DEFAULT_BLOCKED_SIGNAL_NUMBERS = [
        SIGCHLD,
        SIGALRM,
    ];

    public function addSignalHandler(int $signalNumber, callable $signalHandler): SignalInterface;

    public function block(): SignalInterface;

    public function unBlock(): SignalInterface;

    public function addBlockedSignalNumber(int $signalNumber): SignalInterface;
}