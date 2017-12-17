<?php

namespace NHDS\Jobs\Data\Job\Collection\Selector;

use NHDS\Jobs\Data\Job\Collection\SelectorInterface;

trait AwareTrait
{
    public function setSelectorJobCollection(SelectorInterface $selectorCollection)
    {
        $this->_create(SelectorInterface::class, $selectorCollection);

        return $this;
    }

    protected function _getSelectorJobCollection(): SelectorInterface
    {
        return $this->_read(SelectorInterface::class);
    }

    protected function _getSelectorJobCollectionClone(): SelectorInterface
    {
        return clone $this->_getSelectorJobCollection();
    }
}