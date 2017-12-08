<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Db\Model\CollectionInterface;

interface IteratorInterface extends \Iterator
{
    public function setCollection(CollectionInterface $collection);

    function rewind();

    function current(): JobInterface;

    function key(): int;

    function next();

    function valid(): bool;
}