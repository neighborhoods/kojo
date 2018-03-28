<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Type\Collection;

use Neighborhoods\Kojo\Data\Job\TypeInterface;
use Neighborhoods\Kojo\Db\Model\CollectionInterface;

interface IteratorInterface extends \Iterator
{
    public function setCollection(CollectionInterface $collection);

    function rewind();

    function current(): TypeInterface;

    function key(): int;

    function next();

    function valid(): bool;
}