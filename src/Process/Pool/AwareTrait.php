<?php

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\Process\PoolInterface;

trait AwareTrait
{
    protected $_pool;

    public function setPool(PoolInterface $pool)
    {
        if (!$this->_hasPool()) {
            $this->_pool = $pool;
        }else {
            throw new \Exception('Pool is already set.');
        }

        return $this;
    }

    protected function _getPool(): PoolInterface
    {
        if (!$this->_hasPool()) {
            throw new \LogicException('Pool is not set.');
        }

        return $this->_pool;
    }

    protected function _hasPool(): bool
    {
        return $this->_pool === null ? false : true;
    }
}