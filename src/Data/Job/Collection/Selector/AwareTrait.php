<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection\Selector;

use Neighborhoods\Kojo\Data\Job\Collection\SelectorInterface;

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