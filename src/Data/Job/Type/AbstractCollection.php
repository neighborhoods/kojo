<?php

namespace NHDS\Jobs\Data\Job\Type;

use NHDS\Jobs\Data\Job\Type\Collection\IteratorInterface;
use NHDS\Jobs\Db;

abstract class AbstractCollection extends Db\Model\AbstractCollection implements CollectionInterface
{
    public function setIterator(IteratorInterface $iterator)
    {
        $iterator->setCollection($this);
        $this->_create(IteratorInterface::class, $iterator);

        return $this;
    }

    public function getIterator(): IteratorInterface
    {
        return $this->_read(IteratorInterface::class);
    }
}