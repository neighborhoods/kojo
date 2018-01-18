<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Type\Collection;

use NHDS\Jobs\Data\Job\TypeInterface;
use NHDS\Jobs\Db\Model\CollectionInterface;

interface IteratorInterface extends \Iterator
{
    public function setCollection(CollectionInterface $collection);

    function rewind();

    function current(): TypeInterface;

    function key(): int;

    function next();

    function valid(): bool;
}