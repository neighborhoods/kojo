<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\Decorator\Factory;

use Neighborhoods\Kojo\Doctrine\Connection\Decorator\FactoryInterface;

trait AwareTrait
{
    public function setDoctrineConnectionDecoratorFactory(FactoryInterface $doctrineConnectionDecoratorFactory) : self
    {
        $this->_create(FactoryInterface::class, $doctrineConnectionDecoratorFactory);

        return $this;
    }

    protected function _getDoctrineConnectionDecoratorFactory() : FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _hasDoctrineConnectionDecoratorFactory() : bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetDoctrineConnectionDecoratorFactory() : self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}
