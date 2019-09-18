<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal;

use LogicException;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Process\Signal\Handler\DecoratorInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use RuntimeException;

class Dispatcher implements DispatcherInterface
{
    use Defensive\AwareTrait;
    use Process\Signal\Information\Factory\AwareTrait;
    use Process\Pool\Logger\AwareTrait;
    use Process\Signal\Handler\Decorator\Factory\AwareTrait;

    protected const HANDLE_SIGNAL = 'handleSignal';

    protected $handlerDecorators = [];
    protected $bufferedSignals = [];

    public function registerSignalHandler(
        int $signalNumber,
        HandlerInterface $handler,
        bool $isBuffered
    ): DispatcherInterface {
        pcntl_async_signals(true);
        $handlerDecorator = $this->getProcessSignalHandlerDecoratorFactory()->create();
        $handlerDecorator->setProcessSignalHandler($handler);
        $handlerDecorator->setIsBuffered($isBuffered);
        $this->handlerDecorators[$signalNumber] = $handlerDecorator;
        pcntl_signal($signalNumber, [$this, self::HANDLE_SIGNAL]);

        return $this;
    }

    public function processBufferedSignals(): DispatcherInterface
    {
        foreach ($this->bufferedSignals as $position => $information) {
            unset($this->bufferedSignals[$position]);
            $this->processSignalInformation($information);
        }

        return $this;
    }

    public function ignoreSignal(int $signalNumber): DispatcherInterface
    {
        if (!isset($this->handlerDecorators[$signalNumber])) {
            throw new LogicException(sprintf('Signal number [%s] does not have a Handler.', $signalNumber));
        }

        pcntl_signal($signalNumber, SIG_IGN);
        unset($this->handlerDecorators[$signalNumber]);

        return $this;
    }

    protected function processSignalInformation(InformationInterface $information): DispatcherInterface
    {
        call_user_func(
            [$this->getHandlerDecorator($information->getSignalNumber()), self::HANDLE_SIGNAL],
            $information
        );

        return $this;
    }

    protected function getHandlerDecorator(int $signalNumber): DecoratorInterface
    {
        if (!isset($this->handlerDecorators[$signalNumber])) {
            throw new LogicException(sprintf('Handler Decorator for signal number [%s] is not set.', $signalNumber));
        }

        return $this->handlerDecorators[$signalNumber];
    }

    public function handleSignal(int $signalNumber, $signalInformation): void
    {
        $this->_getLogger()->debug(sprintf('Received signal [%s].', $signalNumber));
        if ($signalNumber === SIGCHLD) {
            while ($childProcessId = pcntl_wait($status, WNOHANG)) {
                $lastPCNTLError = pcntl_get_last_error();
                if ($childProcessId !== -1) {
                    $this->_getLogger()->debug(
                        sprintf('Child with process ID [%s] exited with status [%s].', $childProcessId, $status)
                    );
                    $childInformation[InformationInterface::SIGNAL_NUMBER] = SIGCHLD;
                    $childInformation[InformationInterface::PROCESS_ID] = $childProcessId;
                    $childInformation[InformationInterface::EXIT_VALUE] = $status;
                    $information = $this->_getProcessSignalInformationFactory()->create()->hydrate($childInformation);
                    $this->routeInformation($information);
                } elseif ($lastPCNTLError === PCNTL_ECHILD) {
                    break;
                } else {
                    $message = sprintf('Encountered PCNTL error [%s] while processing SIGCHLD.', $lastPCNTLError);
                    $this->_getLogger()->critical($message);
                    throw new RuntimeException($message);
                }
            }
        } else {
            $this->routeInformation($this->_getProcessSignalInformationFactory()->create()->hydrate($signalInformation));
        }

        /** @noinspection UselessReturnInspection */
        return;
    }

    protected function routeInformation(InformationInterface $information): DispatcherInterface
    {
        if ($this->getHandlerDecorator($information->getSignalNumber())->isBuffered()) {
            $this->bufferSignalInformation($information);
        } else {
            $this->processSignalInformation($information);
        }

        return $this;
    }

    protected function bufferSignalInformation(InformationInterface $information): DispatcherInterface
    {
        $this->bufferedSignals[] = $information;

        return $this;
    }
}
