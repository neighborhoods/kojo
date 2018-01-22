<?php
declare(strict_types=1);

namespace NHDS\Jobs\Type\Repository;

use NHDS\Jobs\Type\RepositoryInterface;

trait AwareTrait
{
    public function setTypeRepository(RepositoryInterface $typeRepository)
    {
        $this->_create(RepositoryInterface::class, $typeRepository);

        return $this;
    }

    protected function _getTypeRepository(): RepositoryInterface
    {
        return $this->_read(RepositoryInterface::class);
    }

    protected function _unsetTypeRepository()
    {
        $this->_delete(RepositoryInterface::class);

        return $this;
    }
}