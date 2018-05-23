<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\Connection\Decorator\Repository;

use Neighborhoods\Kojo\Doctrine\Connection\Decorator\RepositoryInterface;

trait AwareTrait
{
    public function setDoctrineConnectionDecoratorRepository(RepositoryInterface $doctrineConnectionDecoratorRepository
    ) : self {
        $this->_create(RepositoryInterface::class, $doctrineConnectionDecoratorRepository);

        return $this;
    }

    protected function _getDoctrineConnectionDecoratorRepository() : RepositoryInterface
    {
        return $this->_read(RepositoryInterface::class);
    }

    protected function _hasDoctrineConnectionDecoratorRepository() : bool
    {
        return $this->_exists(RepositoryInterface::class);
    }

    protected function _unsetDoctrineConnectionDecoratorRepository() : self
    {
        $this->_delete(RepositoryInterface::class);

        return $this;
    }
}
