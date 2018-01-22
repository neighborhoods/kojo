<?php
declare(strict_types=1);

namespace NHDS\Jobs\Selector;

use NHDS\Jobs\SelectorInterface;

trait AwareTrait
{
    public function setSelector(SelectorInterface $selector)
    {
        $this->_create(SelectorInterface::class, $selector);

        return $this;
    }

    protected function _getSelector(): SelectorInterface
    {
        return $this->_read(SelectorInterface::class);
    }

    protected function _getSelectorClone(): SelectorInterface
    {
        return clone $this->_getSelector();
    }
}