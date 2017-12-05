<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\JobInterface;

interface IteratorInterface extends \Iterator
{
    function rewind();

    function current(): JobInterface;

    function key(): int;

    function next(): JobInterface;

    function valid(): bool;
}