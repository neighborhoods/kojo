<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\Decorator;

use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;

trait AwareTrait
{
    public function setDoctrineConnectionDecorator(DecoratorInterface $doctrineConnectionDecorator) : self
    {
        $this->_create(DecoratorInterface::class, $doctrineConnectionDecorator);

        return $this;
    }

    protected function _getDoctrineConnectionDecorator() : DecoratorInterface
    {
        return $this->_read(DecoratorInterface::class);
    }

    protected function _hasDoctrineConnectionDecorator() : bool
    {
        return $this->_exists(DecoratorInterface::class);
    }

    protected function _unsetDoctrineConnectionDecorator() : self
    {
        $this->_delete(DecoratorInterface::class);

        return $this;
    }
}
