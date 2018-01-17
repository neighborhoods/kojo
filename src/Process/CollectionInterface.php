<?php

namespace NHDS\Jobs\Process;

use NHDS\Jobs\Process\Collection\IteratorInterface;
use NHDS\Jobs\ProcessInterface;

interface CollectionInterface extends \IteratorAggregate
{
    public function addProcessPrototype(ProcessInterface $process): CollectionInterface;

    public function getProcessPrototypes(): array;

    public function setIterator(IteratorInterface $iterator);

    public function getIterator(): IteratorInterface;

    public function getProcessPrototypeClone(string $typeCode): ProcessInterface;

    public function applyProcessPool(PoolInterface $pool): CollectionInterface;
}