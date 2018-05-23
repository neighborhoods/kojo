<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\DecoratorArray\Factory;

use Neighborhoods\Kojo\Doctrine\Connection\DecoratorArray\FactoryInterface;

trait AwareTrait
{
    public function setDoctrineConnectionDecoratorArrayFactory(FactoryInterface $doctrineConnectionDecoratorArrayFactory
    ): self {
        $this->_create(FactoryInterface::class, $doctrineConnectionDecoratorArrayFactory);

        return $this;
    }

    protected function _getDoctrineConnectionDecoratorArrayFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _hasDoctrineConnectionDecoratorArrayFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetDoctrineConnectionDecoratorArrayFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}
