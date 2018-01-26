<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Pool\Strategy;

use NHDS\Jobs\Process\Pool\StrategyInterface;

trait AwareTrait
{
    public function setProcessPoolStrategy(StrategyInterface $strategy): self
    {
        $this->_create(StrategyInterface::class, $strategy);

        return $this;
    }

    protected function _getProcessPoolStrategy(): StrategyInterface
    {
        return $this->_read(StrategyInterface::class);
    }

    protected function _hasProcessPoolStrategy(): bool
    {
        return $this->_exists(StrategyInterface::class);
    }

    protected function _getProcessPoolStrategyClone(): StrategyInterface
    {
        return clone $this->_getProcessPoolStrategy();
    }

    protected function _unsetProcessPoolStrategy(): self
    {
        $this->_delete(StrategyInterface::class);

        return $this;
    }
}