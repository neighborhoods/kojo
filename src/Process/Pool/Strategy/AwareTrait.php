<?php

namespace NHDS\Jobs\Process\Pool\Strategy;

use NHDS\Jobs\Process\Pool\StrategyInterface;

trait AwareTrait
{
    public function setStrategy(StrategyInterface $strategy)
    {
        $this->_create(StrategyInterface::class, $strategy);

        return $this;
    }

    protected function _getStrategy(): StrategyInterface
    {
        return $this->_read(StrategyInterface::class);
    }
}