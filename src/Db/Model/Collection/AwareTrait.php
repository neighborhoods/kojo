<?php

namespace NHDS\Jobs\Db\Model\Collection;

use NHDS\Jobs\Db\Model\CollectionInterface;

trait AwareTrait
{
    public function setCollection(CollectionInterface $collection)
    {
        $this->_create(CollectionInterface::class, $collection);

        return $this;
    }

    protected function _getCollection(): CollectionInterface
    {
        return $this->_read(CollectionInterface::class);
    }
}