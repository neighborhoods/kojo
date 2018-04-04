<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal;

interface HandlerInterface
{
    public function handleSignal(InformationInterface $signalInformation): HandlerInterface;
}