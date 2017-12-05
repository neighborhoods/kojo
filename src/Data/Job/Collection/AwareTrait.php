<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\Job\Collection;

trait AwareTrait
{
    public function setCollection(Collection $collection)
    {
        $this->_create(Collection::class, $collection);

        return $this;
    }

    protected function _getCollection(): Collection
    {
        return $this->_read(Collection::class);
    }

    protected function _getCollectionClone(): Collection
    {
        return clone $this->_getCollection();
    }
}