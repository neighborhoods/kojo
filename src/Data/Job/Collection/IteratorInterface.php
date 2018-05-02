<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Db\Model\CollectionInterface;

interface IteratorInterface extends \Iterator
{
    public function setCollection(CollectionInterface $collection);

    function rewind();

    function current(): JobInterface;

    function key(): int;

    function next();

    function valid(): bool;

    public function initialize(): IteratorInterface;
}