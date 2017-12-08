<?php

namespace NHDS\Jobs\Data\Job\Type;

use NHDS\Jobs\Data\Job\Type\Collection\IteratorInterface;
use NHDS\Jobs\Db\Model;

interface CollectionInterface extends Model\CollectionInterface
{
    public function setIterator(IteratorInterface $iterator);

    public function getIterator(): IteratorInterface;
}