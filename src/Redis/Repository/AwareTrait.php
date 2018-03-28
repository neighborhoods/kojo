<?php
declare(strict_types=1);

namespace NHDS\Jobs\Redis\Repository;

use NHDS\Jobs\Redis\RepositoryInterface;

trait AwareTrait
{
    public function setRedisRepository(RepositoryInterface $redisRepository): self
    {
        $this->_create(RepositoryInterface::class, $redisRepository);

        return $this;
    }

    protected function _getRedisRepository(): RepositoryInterface
    {
        return $this->_read(RepositoryInterface::class);
    }

    protected function _getRedisRepositoryClone(): RepositoryInterface
    {
        return clone $this->_getRedisRepository();
    }

    protected function _hasRedisRepository(): bool
    {
        return $this->_exists(RepositoryInterface::class);
    }

    protected function _unsetRedisRepository(): self
    {
        $this->_delete(RepositoryInterface::class);

        return $this;
    }
}