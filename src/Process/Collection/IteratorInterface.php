<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Collection;

use NHDS\Jobs\Process\CollectionInterface;
use NHDS\Jobs\ProcessInterface;

interface IteratorInterface extends \Iterator
{
    public function setProcessCollection(CollectionInterface $collection);

    public function initialize(): IteratorInterface;

    function rewind();

    function current(): ProcessInterface;

    function key(): int;

    function next();

    function valid(): bool;
}