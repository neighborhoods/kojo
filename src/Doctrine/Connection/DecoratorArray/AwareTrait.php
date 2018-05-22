<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\DecoratorArray;

use Neighborhoods\Kojo\Doctrine\Connection\DecoratorArrayInterface;

trait AwareTrait
{
    public function setDoctrineConnectionDecoratorArray(DecoratorArrayInterface $doctrineConnectionDecoratorArray
    ) : self {
        $this->_create(DecoratorArrayInterface::class, $doctrineConnectionDecoratorArray);

        return $this;
    }

    protected function _getDoctrineConnectionDecoratorArray() : DecoratorArrayInterface
    {
        return $this->_read(DecoratorArrayInterface::class);
    }

    protected function _hasDoctrineConnectionDecoratorArray() : bool
    {
        return $this->_exists(DecoratorArrayInterface::class);
    }

    protected function _unsetDoctrineConnectionDecoratorArray() : self
    {
        $this->_delete(DecoratorArrayInterface::class);

        return $this;
    }
}
