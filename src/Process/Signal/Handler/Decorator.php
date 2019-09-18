<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Handler;

use LogicException;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Process\Signal\HandlerInterface;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;

class Decorator implements DecoratorInterface
{
    use Process\Signal\Handler\AwareTrait;
    use Process\Signal\Handler\Decorator\AwareTrait;

    protected $IsBuffered;

    public function handleSignal(InformationInterface $signalInformation): HandlerInterface
    {
        if ($this->hasProcessSignalHandler()) {
            $this->getProcessSignalHandler()->handleSignal($signalInformation);
        } else {
            $this->getProcessSignalHandlerDecorator()->handleSignal($signalInformation);
        }

        return $this;
    }

    public function isBuffered(): bool
    {
        if ($this->IsBuffered === null) {
            throw new LogicException('Is Buffered has not been set.');
        }

        return $this->IsBuffered;
    }

    public function setIsBuffered(bool $IsBuffered): DecoratorInterface
    {
        if ($this->IsBuffered !== null) {
            throw new LogicException('Is Buffered is already set.');
        }

        $this->IsBuffered = $IsBuffered;

        return $this;
    }
}
