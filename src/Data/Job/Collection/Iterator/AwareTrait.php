<?php

namespace NHDS\Jobs\Data\Job\Collection\Iterator;

use NHDS\Jobs\Data\Job\Collection\IteratorInterface;

trait AwareTrait
{
    public function setIterator(IteratorInterface $iterator)
    {
        $this->_create(IteratorInterface::class, $iterator);

        return $this;
    }

    public function getIterator(): IteratorInterface
    {
        return $this->_read(IteratorInterface::class);
    }
}