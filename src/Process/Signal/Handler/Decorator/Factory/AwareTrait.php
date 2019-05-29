<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Handler\Decorator\Factory;

use LogicException;
use Neighborhoods\Kojo\Process\Signal\Handler\Decorator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessSignalHandlerDecoratorFactory;

    public function setProcessSignalHandlerDecoratorFactory(FactoryInterface $processSignalHandlerDecoratorFactory
    ): self {
        if ($this->hasProcessSignalHandlerDecoratorFactory()) {
            throw new LogicException('Neighborhoods Kojo Process Signal Handler Decorator Factory is already set.');
        }
        $this->NeighborhoodsKojoProcessSignalHandlerDecoratorFactory = $processSignalHandlerDecoratorFactory;

        return $this;
    }

    protected function getProcessSignalHandlerDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasProcessSignalHandlerDecoratorFactory()) {
            throw new LogicException('Neighborhoods Kojo Process Signal Handler Decorator Factory is not set.');
        }

        return $this->NeighborhoodsKojoProcessSignalHandlerDecoratorFactory;
    }

    protected function hasProcessSignalHandlerDecoratorFactory(): bool
    {
        return isset($this->NeighborhoodsKojoProcessSignalHandlerDecoratorFactory);
    }

    protected function unsetProcessSignalHandlerDecoratorFactory(): self
    {
        if (!$this->hasProcessSignalHandlerDecoratorFactory()) {
            throw new LogicException('Neighborhoods Kojo Process Signal Handler Decorator Factory is not set.');
        }
        unset($this->NeighborhoodsKojoProcessSignalHandlerDecoratorFactory);

        return $this;
    }
}
