<?php

namespace NHDS\Jobs\Data\Job\Selector;

use NHDS\Jobs\Data\Job\SelectorInterface;

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