<?php

namespace NHDS\Jobs\Process\Type\Collection;

use NHDS\Jobs\Process\Type\CollectionInterface;

trait AwareTrait
{
    public function setProcessTypeCollection(CollectionInterface $collection)
    {
        $this->_create(CollectionInterface::class, $collection);

        return $this;
    }

    protected function _getProcessTypeCollection(): CollectionInterface
    {
        return $this->_read(CollectionInterface::class);
    }
}