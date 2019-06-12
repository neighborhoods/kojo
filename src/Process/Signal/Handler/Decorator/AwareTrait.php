<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Handler\Decorator;

use LogicException;
use Neighborhoods\Kojo\Process\Signal\Handler\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessSignalHandlerDecorator;

    public function setProcessSignalHandlerDecorator(DecoratorInterface $processSignalHandlerDecorator): self
    {
        if ($this->hasProcessSignalHandlerDecorator()) {
            throw new LogicException('Neighborhoods Kojo Process Signal Handler Decorator is already set.');
        }
        $this->NeighborhoodsKojoProcessSignalHandlerDecorator = $processSignalHandlerDecorator;

        return $this;
    }

    protected function getProcessSignalHandlerDecorator(): DecoratorInterface
    {
        if (!$this->hasProcessSignalHandlerDecorator()) {
            throw new LogicException('Neighborhoods Kojo Process Signal Handler Decorator is not set.');
        }

        return $this->NeighborhoodsKojoProcessSignalHandlerDecorator;
    }

    protected function hasProcessSignalHandlerDecorator(): bool
    {
        return isset($this->NeighborhoodsKojoProcessSignalHandlerDecorator);
    }

    protected function unsetProcessSignalHandlerDecorator(): self
    {
        if (!$this->hasProcessSignalHandlerDecorator()) {
            throw new LogicException('Neighborhoods Kojo Process Signal Handler Decorator is not set.');
        }
        unset($this->NeighborhoodsKojoProcessSignalHandlerDecorator);

        return $this;
    }
}
