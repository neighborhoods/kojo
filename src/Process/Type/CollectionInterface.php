<?php

namespace NHDS\Jobs\Process\Type;

use NHDS\Jobs\Process\Type\Collection\IteratorInterface;
use NHDS\Jobs\ProcessInterface;

interface CollectionInterface extends \IteratorAggregate
{
    public function addProcessPrototype(ProcessInterface $process);

    public function getProcessPrototypes(): array;

    public function setIterator(IteratorInterface $iterator);

    public function getIterator(): IteratorInterface;

    public function getProcessTypeClone(string $typeCode): ProcessInterface;
}