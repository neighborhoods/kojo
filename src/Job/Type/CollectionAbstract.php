<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type;

use Neighborhoods\Kojo\Job\Type\Collection\IteratorInterface;
use Neighborhoods\Kojo\Db;

abstract class CollectionAbstract extends Db\Model\CollectionAbstract implements CollectionInterface
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