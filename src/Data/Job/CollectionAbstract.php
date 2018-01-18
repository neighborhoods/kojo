<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\Job\Collection\IteratorInterface;
use NHDS\Jobs\Db;

abstract class CollectionAbstract extends Db\Model\CollectionAbstract
{
    public function setIterator(IteratorInterface $iterator)
    {
        $iterator->setCollection($this);
        $this->_create(IteratorInterface::class, $iterator);

        return $this;
    }

    public function getIterator(): IteratorInterface
    {
        return $this->_getIterator()->initialize();
    }

    protected function _getIterator(): IteratorInterface
    {
        return $this->_read(IteratorInterface::class);
    }
}