<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\Job\AbstractCollection;

trait AwareTrait
{
    public function setCollection(AbstractCollection $collection)
    {
        $this->_create(AbstractCollection::class, $collection);

        return $this;
    }

    protected function _getCollection(): AbstractCollection
    {
        return $this->_read(AbstractCollection::class);
    }

    protected function _getCollectionClone(): AbstractCollection
    {
        return clone $this->_getCollection();
    }
}