<?php

namespace NHDS\Jobs\Process\Type\Collection;

use NHDS\Jobs\Process\Type\CollectionInterface;
use NHDS\Jobs\ProcessInterface;

interface IteratorInterface extends \Iterator
{
    public function setProcessTypeCollection(CollectionInterface $collection);

    public function initialize(): IteratorInterface;

    function rewind();

    function current(): ProcessInterface;

    function key(): int;

    function next();

    function valid(): bool;
}