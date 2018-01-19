<?php
declare(strict_types=1);

namespace NHDS\Watch\Fixture\Expression;

class NumberPool
{
    protected $_nextNumberPool = [];

    public function getCurrentNumber(string $poolName): int
    {
        if (!$this->isPoolInitialized($poolName)) {
            $this->_initializePoolName($poolName);
        }

        return $this->_nextNumberPool[$poolName];
    }

    public function advance(string $poolName): NumberPool
    {
        if (!$this->isPoolInitialized($poolName)) {
            $this->_initializePoolName($poolName);
        }
        ++$this->_nextNumberPool[$poolName];

        return $this;
    }

    public function rewind(string $poolName): NumberPool
    {
        if (!$this->isPoolInitialized($poolName)) {
            $this->_initializePoolName($poolName);
        }
        ++$this->_nextNumberPool[$poolName];

        return $this;
    }

    public function isPoolInitialized(string $poolName): bool
    {
        return isset($this->_nextNumberPool[$poolName]) ? true : false;
    }

    protected function _initializePoolName(string $poolName): NumberPool
    {
        if (isset($this->_nextNumberPool[$poolName])) {
            throw new \LogicException('Pool name is already initialized.');
        }

        $this->_nextNumberPool[$poolName] = 0;

        return $this;
    }
}