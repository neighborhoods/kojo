<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\Job\CollectionAbstract;

trait AwareTrait
{
    public function setCollection(CollectionAbstract $collection)
    {
        $this->_create(CollectionAbstract::class, $collection);

        return $this;
    }

    protected function _getCollection(): CollectionAbstract
    {
        return $this->_read(CollectionAbstract::class);
    }

    protected function _getCollectionClone(): CollectionAbstract
    {
        return clone $this->_getCollection();
    }
}