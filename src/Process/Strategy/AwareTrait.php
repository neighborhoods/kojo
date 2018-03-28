<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Strategy;

use Neighborhoods\Kojo\Process\StrategyInterface;

trait AwareTrait
{
    public function setProcessStrategy(StrategyInterface $strategy)
    {
        $this->_create(StrategyInterface::class, $strategy);

        return $this;
    }

    protected function _getProcessStrategy(): StrategyInterface
    {
        return $this->_read(StrategyInterface::class);
    }

    protected function _getProcessStrategyClone(): StrategyInterface
    {
        return clone $this->_getProcessStrategy();
    }
}